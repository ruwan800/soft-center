#!/usr/bin/php -q
<?php

/**
 * Setup script for CLI and CRON jobs
 */

/**
 * Usage
 *
 * php setup.php help
 */

/**
 * Setup class
 */
class Setup
{

    /**
     * Configuration options
     */
    protected $_config = array();

    /**
     * Parameters from CLI
     */
    protected $_argv = array(
        __FILE__,
        null,
        null,
        null,
        null,
        null
    );

    /**
     * Database connection object
     */
    protected $_db = null;

    /**
     * Constructor
     */
    public function __construct(array $config = null)
    {
        if ($config) {
            $this->_config = $config + $this->_config;
        }
        global $argv;
        if ($argv) {
            $this->_argv = $argv + $this->_argv;
        }

        ini_set('memory_limit', $this->_config['memoryLimit']);
    }

    /**
     * Execute a command
     */
    public function execute()
    {
        switch ($this->_argv[1]) {
            case 'get-repository':
                $this->_getRepository($this->_argv[2], $this->_argv[3]);
                break;
            case 'get-appinstalldata':
                $this->_getAppInstallData($this->_argv[2]);
                break;
            case 'get-popcon':
                $this->_getPopcon($this->_argv[2]);
                break;
            case 'create-tables':
                $this->_createTables();
                break;
            case 'import-packages':
                $this->_importPackages($this->_argv[2], $this->_argv[3], $this->_argv[4], $this->_argv[5]);
                break;
            case 'import-translation':
                $this->_importTranslation($this->_argv[2], $this->_argv[3], $this->_argv[4], $this->_argv[5], $this->_argv[6]);
                break;
            case 'import-desktopentries':
                $this->_importDesktopEntries($this->_argv[2], $this->_argv[3], $this->_argv[4], $this->_argv[5]);
                break;
            case 'import-popcon':
                $this->_importPopcon($this->_argv[2]);
                break;
            case 'convert-icons':
                $this->_convertIcons($this->_argv[2], $this->_argv[3]);
                break;
            case 'help':
                // Continue to default
            default:
                $this->_help();
                break;
        }
    }

    /**
     * Help screen
     */
    protected function _help()
    {
        echo<<<EOL
----------------------------------------

Usage: php {$this->_argv[0]} command [option]

Commands and Options:
  help
  get-repository [apt line] [distro name]
  get-appinstalldata [apt/bzr]
  get-popcon [by_inst/by_vote/by_old/by_recent/by_no-files]
  create-tables
  import-packages [packages file] [repository] [distribution] [component]
  import-translation [translation file]  [repository] [distribution] [component] [lang]
  import-desktopentries [desktopentries dir] [icons dir] [entries] [additional category]
  import-popcon [popcon file]
  convert-icons [icons dir] [small/medium/large]

----------------------------------------

EOL;
        exit;
    }

    /**
     * Get Packages files and Translation files from repository
     */
    protected function _getRepository($aptLine, $distroName = null)
    {
        if (!$aptLine) {
            echo "Insufficient option.\n";
            return false;
        }

        if (preg_match("/^ppa\:(.+)\/(.+)/", $aptLine, $matches)) {
            $aptLine = 'deb http://ppa.launchpad.net/'
                . $matches[1] . '/' . $matches[2]
                . '/ubuntu $distro main';
        }

        if ($distroName) {
            $aptLine = str_ireplace('$distro', $distroName, $aptLine);
        }

        if (!preg_match("/^deb .+ .+ .+/", $aptLine)) {
            echo "Invalid option: $aptLine\n";
            return false;
        }

        $tempDir = $this->_config['tempDir'] . '/repositories';
        $this->_makeDir($tempDir);

        $repository = explode(' ', $aptLine);
        $type = $repository[0];
        $uri = rtrim($repository[1], '/');
        $disribution = $repository[2];
        unset($repository[0], $repository[1], $repository[2]);
        $components = $repository;
        $repositoryBase = preg_replace("/.+\:\/\/(.+)/", "$1", $uri);

        foreach ($components as $component) {
            // Get Packages file
            foreach ($this->_config['architectures'] as $architecture) {
                $packagesBase = "dists/$disribution/$component/binary-$architecture";
                $this->_makeDir("$tempDir/$repositoryBase/$packagesBase");
                $downloadUri = "$uri/$packagesBase/Packages";
                $saveFilename = "$tempDir/$repositoryBase/$packagesBase/Packages";
                $bool = $this->_downloadFile($downloadUri, $saveFilename);
                if (!$bool) {
                    echo "Download failed: $downloadUri\n";
                }
            }
            // Get Translation files from ubuntu.com
            if (strpos($uri, 'ubuntu.com') !== false) {
                $translationBase = "dists/$disribution/$component/i18n";
                $this->_makeDir("$tempDir/$repositoryBase/$translationBase");
                foreach ($this->_config['languages'] as $lang) {
                    $downloadUri = "$uri/$translationBase/Translation-$lang";
                    $saveFilename = "$tempDir/$repositoryBase/$translationBase/Translation-$lang";
                    $bool = $this->_downloadFile($downloadUri, $saveFilename);
                    if (!$bool) {
                        echo "Download failed: $downloadUri\n";
                    }
                }
            }
        }
    }

    /**
     * Get app-install-data source file from repository or Launchpad
     */
    protected function _getAppInstallData($getMode)
    {
        if (!$getMode) {
            echo "Insufficient option.\n";
            return false;
        }
        if (!in_array($getMode, array('apt', 'bzr'))) {
            echo "Invalid option: $getMode\n";
            return false;
        }

        $tempDir = $this->_config['tempDir'] . '/app-install-data';
        $this->_makeDir($tempDir);

        switch ($getMode) {
            case 'apt':
                echo "Downloading app-install-data-ubuntu from repository.\n";
                exec("cd $tempDir"
                    . " && apt-get source --tar-only app-install-data-ubuntu"
                    . " && tar -xzvf ./app-install-data-ubuntu*.tar.gz"
                    . " && mv ./app-install-data-ubuntu*/ ./app-install-data-ubuntu"
                );
                break;
            case 'bzr':
                // Continue to default
            default:
                echo "Downloading app-install-data-ubuntu from lp:app-install-data-ubuntu.\n";
                exec("bzr checkout --lightweight lp:app-install-data-ubuntu $tempDir/app-install-data-ubuntu");
                break;
        }
    }

    /**
     * Get popcon file from popcon.ubuntu.com
     */
    protected function _getPopcon($dataType)
    {
        if (!$dataType) {
            echo "Insufficient option.\n";
            return false;
        }
        if (!in_array($dataType, array('by_inst', 'by_vote', 'by_old', 'by_recent', 'by_no-files'))) {
            echo "Invalid option: $dataType\n";
            return false;
        }

        $tempDir = $this->_config['tempDir'] . '/popcon';
        $this->_makeDir($tempDir);

        $downloadUri = "http://popcon.ubuntu.com/$dataType";
        $saveFilename = "$tempDir/$dataType";
        $bool = $this->_downloadFile($downloadUri, $saveFilename);
        if (!$bool) {
            echo "Download failed: $downloadUri\n";
        }
    }

    /**
     * Create a database tables
     */
    protected function _createTables()
    {
        if (strpos($this->_config['dbDsn'], 'mysql:') === 0) {
            $idDifinition = 'INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY';
            $timestampDifinition = 'DATETIME NOT NULL';
        }
        else if (strpos($this->_config['dbDsn'], 'sqlite:') === 0) {
            $idDifinition = 'INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT';
            $timestampDifinition = 'CHAR(19) NOT NULL';
        }
        else {
            echo "Invalid DSN: {$this->_config['dbDsn']}\n";
            return false;
        }

        $this->_connectDb();

        // Packages table
        $this->_db->exec("DROP TABLE IF EXISTS {$this->_config['dbTablePrefix']}packages;");
        $this->_db->exec(
            "CREATE TABLE {$this->_config['dbTablePrefix']}packages"
            . " (id $idDifinition,"
            . " active INTEGER(1) NOT NULL DEFAULT 1,"
            . " package VARCHAR(64) NOT NULL,"
            . " repository VARCHAR(255) NOT NULL,"
            . " distribution VARCHAR(32) NOT NULL,"
            . " component VARCHAR(32) NOT NULL,"
            . " architecture VARCHAR(16) NOT NULL,"
            . " version VARCHAR(64),"
            . " filename VARCHAR(255) NOT NULL,"
            . " size INTEGER,"
            . " installedsize INTEGER,"
            . " maintainer VARCHAR(255),"
            . " essential VARCHAR(3),"
            . " priority VARCHAR(32),"
            . " section VARCHAR(128),"
            . " depends VARCHAR(255),"
            . " predepends VARCHAR(255),"
            . " recommends VARCHAR(255),"
            . " suggests VARCHAR(255),"
            . " conflicts VARCHAR(255),"
            . " replaces VARCHAR(255),"
            . " provides VARCHAR(255),"
            . " description VARCHAR(255) NOT NULL,"
            . " longdescription TEXT,"
            . " homepage VARCHAR(255));"
        );
        $this->_db->exec(
            "CREATE INDEX index_package"
            . " ON {$this->_config['dbTablePrefix']}packages"
            . " (active, package);"
        );
        $this->_db->exec(
            "CREATE INDEX index_repository"
            . " ON {$this->_config['dbTablePrefix']}packages"
            . " (repository, distribution, component);"
        );
        $this->_db->exec(
            "CREATE INDEX index_search"
            . " ON {$this->_config['dbTablePrefix']}packages"
            . " (section);"
        );

        // Translations table
        $this->_db->exec("DROP TABLE IF EXISTS {$this->_config['dbTablePrefix']}translations;");
        $this->_db->exec(
            "CREATE TABLE {$this->_config['dbTablePrefix']}translations"
            . " (id $idDifinition,"
            . " package VARCHAR(64) NOT NULL,"
            . " repository VARCHAR(255) NOT NULL,"
            . " distribution VARCHAR(32) NOT NULL,"
            . " component VARCHAR(32) NOT NULL,"
            . " lang VARCHAR(5) NOT NULL,"
            . " description VARCHAR(255) NOT NULL,"
            . " longdescription TEXT);"
        );
        $this->_db->exec(
            "CREATE INDEX index_package"
            . " ON {$this->_config['dbTablePrefix']}translations"
            . " (package);"
        );
        $this->_db->exec(
            "CREATE INDEX index_repository"
            . " ON {$this->_config['dbTablePrefix']}translations"
            . " (repository, distribution, component);"
        );
        $this->_db->exec(
            "CREATE INDEX index_search"
            . " ON {$this->_config['dbTablePrefix']}translations"
            . " (lang);"
        );

        // Applications table
        $this->_db->exec("DROP TABLE IF EXISTS {$this->_config['dbTablePrefix']}applications;");
        $this->_db->exec(
            "CREATE TABLE {$this->_config['dbTablePrefix']}applications"
            . " (id $idDifinition,"
            . " package VARCHAR(64) NOT NULL UNIQUE,"
            . " entries VARCHAR(64) NOT NULL,"
            . " name VARCHAR(128) NOT NULL,"
            . " comment VARCHAR(255),"
            . " categories VARCHAR(255),"
            . " icon VARCHAR(255));"
        );
        $this->_db->exec(
            "CREATE INDEX index_search"
            . " ON {$this->_config['dbTablePrefix']}applications"
            . " (categories);"
        );

        // Popularities table
        $this->_db->exec("DROP TABLE IF EXISTS {$this->_config['dbTablePrefix']}popularities;");
        $this->_db->exec(
            "CREATE TABLE {$this->_config['dbTablePrefix']}popularities"
            . " (id $idDifinition,"
            . " package VARCHAR(64) NOT NULL UNIQUE,"
            . " inst INTEGER DEFAULT 0,"
            . " vote INTEGER DEFAULT 0,"
            . " old INTEGER DEFAULT 0,"
            . " recent INTEGER DEFAULT 0,"
            . " nofiles INTEGER DEFAULT 0);"
        );
        $this->_db->exec(
            "CREATE INDEX index_search"
            . " ON {$this->_config['dbTablePrefix']}popularities"
            . " (inst);"
        );

        // Repositories table
        $this->_db->exec("DROP TABLE IF EXISTS {$this->_config['dbTablePrefix']}repositories;");
        $this->_db->exec(
            "CREATE TABLE {$this->_config['dbTablePrefix']}repositories"
            . " (id $idDifinition,"
            . " repository VARCHAR(255) NOT NULL UNIQUE,"
            . " provider VARCHAR(32) NOT NULL,"
            . " description VARCHAR(255),"
            . " homepage VARCHAR(255),"
            . " referencepage VARCHAR(255));"
        );
        $this->_db->exec(
            "CREATE INDEX index_search"
            . " ON {$this->_config['dbTablePrefix']}repositories"
            . " (provider);"
        );

        // Ratings table
        $this->_db->exec("DROP TABLE IF EXISTS {$this->_config['dbTablePrefix']}ratings;");
        $this->_db->exec(
            "CREATE TABLE {$this->_config['dbTablePrefix']}ratings"
            . " (id $idDifinition,"
            . " package VARCHAR(64) NOT NULL UNIQUE,"
            . " timestamp $timestampDifinition,"
            . " recommend INTEGER DEFAULT 0,"
            . " install INTEGER DEFAULT 0);"
        );
        $this->_db->exec(
            "CREATE INDEX index_search"
            . " ON {$this->_config['dbTablePrefix']}ratings"
            . " (recommend, install);"
        );

        $this->_disconnectDb();
    }

    /**
     * Import Packages data into database
     */
    protected function _importPackages($packagesFile, $repository, $distribution, $component)
    {
        if (!$packagesFile || !$repository || !$distribution || !$component) {
            echo "Insufficient option.\n";
            return false;
        }
        if (!is_file($packagesFile)) {
            echo "File not found: $packagesFile\n";
            return false;
        }

        $repository = rtrim($repository, '/') . '/';

        $source = $this->_getContents($packagesFile);
        $packages = $this->_parsePackages($source);

        if (!$packages) {
            echo "No data: $packagesFile\n";
            return false;
        }

        $this->_connectDb();

        $statement = $this->_db->prepare(
            "DELETE FROM {$this->_config['dbTablePrefix']}packages"
            . " WHERE repository = :repository"
            . " AND distribution = :distribution"
            . " AND component = :component;"
        );
        $statement->execute(array(
            ':repository' => $repository,
            ':distribution' => $distribution,
            ':component' => $component
        ));
        $statement->closeCursor();

        $statement = $this->_db->prepare(
            "INSERT INTO {$this->_config['dbTablePrefix']}packages"
            . " (package, repository, distribution, component, architecture, version,"
            . " filename, size, installedsize, maintainer, essential, priority, section,"
            . " depends, predepends, recommends, suggests, conflicts, replaces, provides,"
            . " description, longdescription, homepage)"
            . " VALUES (:package, :repository, :distribution, :component, :architecture, :version,"
            . " :filename, :size, :installedsize, :maintainer, :essential, :priority, :section,"
            . " :depends, :predepends, :recommends, :suggests, :conflicts, :replaces, :provides,"
            . " :description, :longdescription, :homepage);"
        );
        foreach ($packages as $values) {
            $statement->execute(array(
                ':package' => $values['package'],
                ':repository' => $repository,
                ':distribution' => $distribution,
                ':component' => $component,
                ':architecture' => $values['architecture'],
                ':version' => $values['version'],
                ':filename' => $values['filename'],
                ':size' => $values['size'],
                ':installedsize' => $values['installedsize'],
                ':maintainer' => $values['maintainer'],
                ':essential' => $values['essential'],
                ':priority' => $values['priority'],
                ':section' => $values['section'],
                ':depends' => $values['depends'],
                ':predepends' => $values['predepends'],
                ':recommends' => $values['recommends'],
                ':suggests' => $values['suggests'],
                ':conflicts' => $values['conflicts'],
                ':replaces' => $values['replaces'],
                ':provides' => $values['provides'],
                ':description' => $values['description'],
                ':longdescription' => $values['longdescription'],
                ':homepage' => $values['homepage']
            ));
        }
        $statement->closeCursor();

        $this->_disconnectDb();
    }

    /**
     * Import Translation data into database
     */
    protected function _importTranslation($translationFile, $repository, $distribution, $component, $lang)
    {
        if (!$translationFile || !$repository || !$distribution || !$component || !$lang) {
            echo "Insufficient option.\n";
            return false;
        }
        if (!is_file($translationFile)) {
            echo "File not found: $translationFile\n";
            return false;
        }

        $repository = rtrim($repository, '/') . '/';

        $source = $this->_getContents($translationFile);
        $translation = $this->_parsePackages($source);

        if (!$translation) {
            echo "No data: $translationFile\n";
            return false;
        }

        $this->_connectDb();

        $statement = $this->_db->prepare(
            "DELETE FROM {$this->_config['dbTablePrefix']}translations"
            . " WHERE repository = :repository"
            . " AND distribution = :distribution"
            . " AND component = :component"
            . " AND lang = :lang;"
        );
        $statement->execute(array(
            ':repository' => $repository,
            ':distribution' => $distribution,
            ':component' => $component,
            ':lang' => $lang
        ));
        $statement->closeCursor();

        $statement = $this->_db->prepare(
            "INSERT INTO {$this->_config['dbTablePrefix']}translations"
            . " (package, repository, distribution, component, lang,"
            . " description, longdescription)"
            . " VALUES (:package, :repository, :distribution, :component, :lang,"
            . " :description, :longdescription);"
        );
        foreach ($translation as $values) {
            $statement->execute(array(
                ':package' => $values['package'],
                ':repository' => $repository,
                ':distribution' => $distribution,
                ':component' => $component,
                ':lang' => $lang,
                ':description' => $values['description'],
                ':longdescription' => $values['longdescription']
            ));
        }
        $statement->closeCursor();

        $this->_disconnectDb();
    }

    /**
     * Import .desktop entry data into database
     */
    protected function _importDesktopEntries($desktopentriesDir, $iconsDir, $entries, $additionalCategory = null)
    {
        if (!$desktopentriesDir || !$iconsDir || !$entries) {
            echo "Insufficient option.\n";
            return false;
        }
        if (!is_dir($desktopentriesDir)) {
            echo "Directory not found: $desktopentriesDir\n";
            return false;
        }
        if (!is_dir($iconsDir)) {
            echo "Directory not found: $iconsDir\n";
            return false;
        }

        $desktopentries = array();

        $desktopentriesDir = rtrim($desktopentriesDir, '/');
        $iconsDir = rtrim($iconsDir, '/');
        $filenames = scandir($desktopentriesDir);

        foreach ($filenames as $filename) {
            if (!preg_match("/.+\.desktop$/i", $filename)
                || !is_file("$desktopentriesDir/$filename")
            ) {
                continue;
            }
            $source = $this->_getContents("$desktopentriesDir/$filename");
            $desktopentry = $this->_parseDesktopEntry($source);
            if (!$desktopentry) {
                continue;
            }
            if ($additionalCategory) {
                $desktopentry['categories'] = rtrim($desktopentry['categories'], ';')
                    . ';' . $additionalCategory;
            }
            if (!empty($desktopentry['icon'])) {
                $desktopentry['icon'] = preg_replace(
                    "/(.+)\.(ico|xpm|bmp|tiff?|png|gif|jpe?g|svg)$/i",
                    "$1",
                    $desktopentry['icon']
                );
                if (!is_file("$iconsDir/{$desktopentry['icon']}.ico")
                    && !is_file("$iconsDir/{$desktopentry['icon']}.xpm")
                    && !is_file("$iconsDir/{$desktopentry['icon']}.bmp")
                    && !is_file("$iconsDir/{$desktopentry['icon']}.tiff")
                    && !is_file("$iconsDir/{$desktopentry['icon']}.tif")
                    && !is_file("$iconsDir/{$desktopentry['icon']}.png")
                    && !is_file("$iconsDir/{$desktopentry['icon']}.gif")
                    && !is_file("$iconsDir/{$desktopentry['icon']}.jpeg")
                    && !is_file("$iconsDir/{$desktopentry['icon']}.jpg")
                    && !is_file("$iconsDir/{$desktopentry['icon']}.svg")
                ) {
                    echo "Icon not registered: {$desktopentry['icon']}\n";
                    $desktopentry['icon'] = null;
                }
            }
            $desktopentries[] = $desktopentry;
        }

        if (!$desktopentries) {
            echo "No data: $desktopentriesDir\n";
            return false;
        }

        $this->_connectDb();

        $statement = $this->_db->prepare(
            "DELETE FROM {$this->_config['dbTablePrefix']}applications"
            . " WHERE entries = :entries;"
        );
        $statement->execute(array(':entries' => $entries));
        $statement->closeCursor();

        $statement = $this->_db->prepare(
            "INSERT INTO {$this->_config['dbTablePrefix']}applications"
            . " (package, entries, name, comment, categories, icon)"
            . " VALUES (:package, :entries, :name, :comment, :categories, :icon);"
        );
        foreach ($desktopentries as $values) {
            $statement->execute(array(
                ':package' => $values['package'],
                ':entries' => $entries,
                ':name' => $values['name'],
                ':comment' => $values['comment'],
                ':categories' => $values['categories'],
                ':icon' => $values['icon']
            ));
        }
        $statement->closeCursor();

        $this->_disconnectDb();
    }

    /**
     * Import popcon data into database
     */
    protected function _importPopcon($popconFile)
    {
        if (!$popconFile) {
            echo "Insufficient option.\n";
            return false;
        }
        if (!is_file($popconFile)) {
            echo "File not found: $popconFile\n";
            return false;
        }

        $source = $this->_getContents($popconFile);
        $popcon = $this->_parsePopcon($source);

        if (!$popcon) {
            echo "No data: $popconFile\n";
            return false;
        }

        $this->_connectDb();

        $statement = $this->_db->prepare("DELETE FROM {$this->_config['dbTablePrefix']}popularities");
        $statement->execute();
        $statement->closeCursor();

        $statement = $this->_db->prepare(
            "INSERT INTO {$this->_config['dbTablePrefix']}popularities"
            . " (package, inst, vote, old, recent, nofiles)"
            . " VALUES (:package, :inst, :vote, :old, :recent, :nofiles);"
        );
        foreach ($popcon as $values) {
            $statement->execute(array(
                ':package' => $values['package'],
                ':inst' => $values['inst'],
                ':vote' => $values['vote'],
                ':old' => $values['old'],
                ':recent' => $values['recent'],
                ':nofiles' => $values['nofiles']
            ));
        }
        $statement->closeCursor();

        $this->_disconnectDb();
    }

    /**
     * Convert an icons
     */
    protected function _convertIcons($iconsDir, $iconType) {
        if (!$iconsDir || !$iconType) {
            echo "Insufficient option.\n";
            return false;
        }
        if (!is_dir($iconsDir)) {
            echo "Directory not found: $iconsDir\n";
            return false;
        }
        if (!in_array($iconType, array('small', 'medium', 'large'))) {
            echo "Invalid option: $iconType\n";
            return false;
        }

        $iconsDir = rtrim($iconsDir, '/');

        switch ($iconType) {
            case 'small':
                $tempDir = $this->_config['tempDir'] . '/icons-small-temp';
                $saveDir = $this->_config['smallIconsDir'];
                $geometry = $this->_config['smallIconsGeometry'];
                $format = $this->_config['smallIconsFormat'];
                break;
            case 'medium':
                $tempDir = $this->_config['tempDir'] . '/icons-medium-temp';
                $saveDir = $this->_config['mediumIconsDir'];
                $geometry = $this->_config['mediumIconsGeometry'];
                $format = $this->_config['mediumIconsFormat'];
                break;
            case 'large':
                // Continue to default
            default:
                $tempDir = $this->_config['tempDir'] . '/icons-large-temp';
                $saveDir = $this->_config['largeIconsDir'];
                $geometry = $this->_config['largeIconsGeometry'];
                $format = $this->_config['largeIconsFormat'];
                break;
        }

        $this->_makeDir($tempDir);
        $this->_makeDir($saveDir);

        exec("cp $iconsDir/*.* $tempDir");
        exec("mogrify -geometry $geometry -format $format $tempDir/*");
        exec("mv $tempDir/*.$format $saveDir");

        $this->_removeDir($tempDir);
    }

    /**
     * Parse Packages/Translation data
     */
    protected function _parsePackages($source)
    {
        $packages = array();

        $entries = explode("\n\n", $source);

        foreach ($entries as $entry) {
            if (!preg_match("/\nPackage\:([^\n]+)/", "\n" . $entry)) {
                continue;
            }
            $values = array(
                'package' => null,
                'repository' => null,
                'distribution' => null,
                'component' => null,
                'architecture' => null,
                'version' => null,
                'filename' => null,
                'size' => null,
                'installedsize' => null,
                'maintainer' => null,
                'essential' => null,
                'priority' => null,
                'section' => null,
                'depends' => null,
                'predepends' => null,
                'recommends' => null,
                'suggests' => null,
                'conflicts' => null,
                'replaces' => null,
                'provides' => null,
                'description' => null,
                'longdescription' => null,
                'homepage' => null
            );
            $lines = explode("\n", $entry);
            foreach ($lines as $line) {
                if (preg_match("/^Package\:(.+)/", $line, $matches)) {
                    $values['package'] = trim($matches[1]);
                }
                else if (preg_match("/^Architecture\:(.+)/", $line, $matches)) {
                    $values['architecture'] = trim($matches[1]);
                }
                else if (preg_match("/^Version\:(.+)/", $line, $matches)) {
                    $values['version'] = trim($matches[1]);
                }
                else if (preg_match("/^Filename\:(.+)/", $line, $matches)) {
                    $values['filename'] = trim($matches[1]);
                }
                else if (preg_match("/^Size\:(.+)/", $line, $matches)) {
                    $values['size'] = trim($matches[1]);
                }
                else if (preg_match("/^Installed\-Size\:(.+)/", $line, $matches)) {
                    $values['installedsize'] = trim($matches[1]);
                }
                else if (preg_match("/^Maintainer\:(.+)/", $line, $matches)) {
                    $values['maintainer'] = trim($matches[1]);
                }
                else if (preg_match("/^Essential\:(.+)/", $line, $matches)) {
                    $values['essential'] = trim($matches[1]);
                }
                else if (preg_match("/^Priority\:(.+)/", $line, $matches)) {
                    $values['priority'] = trim($matches[1]);
                }
                else if (preg_match("/^Section\:(.+)/", $line, $matches)) {
                    $values['section'] = trim($matches[1]);
                }
                else if (preg_match("/^Depends\:(.+)/", $line, $matches)) {
                    $values['depends'] = trim($matches[1]);
                }
                else if (preg_match("/^Pre\-Depends\:(.+)/", $line, $matches)) {
                    $values['predepends'] = trim($matches[1]);
                }
                else if (preg_match("/^Recommends\:(.+)/", $line, $matches)) {
                    $values['recommends'] = trim($matches[1]);
                }
                else if (preg_match("/^Suggests\:(.+)/", $line, $matches)) {
                    $values['suggests'] = trim($matches[1]);
                }
                else if (preg_match("/^Conflicts\:(.+)/", $line, $matches)) {
                    $values['conflicts'] = trim($matches[1]);
                }
                else if (preg_match("/^Replaces\:(.+)/", $line, $matches)) {
                    $values['replaces'] = trim($matches[1]);
                }
                else if (preg_match("/^Provides\:(.+)/", $line, $matches)) {
                    $values['provides'] = trim($matches[1]);
                }
                else if (preg_match("/^Description-md5:/", $line)) {
                    continue;
                }
                else if (preg_match("/^Description(\-.+)?\:(.+)/", $line, $matches)) {
                    $values['description'] = trim($matches[2]);
                }
                else if (preg_match("/^ \.?(.*)/", $line, $matches)) {
                    $values['longdescription'] .= trim($matches[1])."\n";
                }
                else if (preg_match("/^Homepage\:(.+)/", $line, $matches)) {
                    $values['homepage'] = trim($matches[1]);
                }
            }
            $packages[] = $values;
        }

        return $packages;
    }

    /**
     * Parse .desktop entry data
     */
    protected function _parseDesktopEntry($source)
    {
        if (!preg_match("/\nX\-AppInstall\-Package\=([^\n]+)/", $source)) {
            return null;
        }

        $desktopentry = array(
            'package' => null,
            'name' => null,
            'comment' => null,
            'categories' => null,
            'icon' => null
        );

        $lines = explode("\n", $source);

        foreach ($lines as $line) {
            if (preg_match("/^X\-AppInstall\-Package\=(.+)/", $line, $matches)) {
                $desktopentry['package'] = trim($matches[1]);
            }
            else if (preg_match("/^Name\=(.+)/", $line, $matches)) {
                $desktopentry['name'] = trim($matches[1]);
            }
            else if (preg_match("/^Comment\=(.+)/", $line, $matches)) {
                $desktopentry['comment'] = trim($matches[1]);
            }
            else if (preg_match("/^Categories\=(.+)/", $line, $matches)) {
                $desktopentry['categories'] = trim($matches[1]);
            }
            else if (preg_match("/^Icon\=(.+)/", $line, $matches)) {
                $desktopentry['icon'] = trim($matches[1]);
            }
        }

        return $desktopentry;
    }

    /**
     * Parse popcon data
     */
    protected function _parsePopcon($source)
    {
        $popcon = array();

        $lines = explode("\n", $source);

        foreach ($lines as $line) {
            if (preg_match("/^[0-9]+ +(.+) +([0-9]+) +([0-9]+) +([0-9]+) +([0-9]+) +([0-9]+) +\((.+)\) */", $line, $matches)) {
                $popcon[] = array(
                    'package' => trim($matches[1]),
                    'inst' => trim($matches[2]),
                    'vote' => trim($matches[3]),
                    'old' => trim($matches[4]),
                    'recent' => trim($matches[5]),
                    'nofiles' => trim($matches[6]),
                    'maintainer' => trim($matches[7])
                );
            }
        }

        return $popcon;
    }

    /**
     * Make a directory
     */
    protected function _makeDir($directory)
    {
        if (!is_dir($directory)) {
            //mkdir($directory, 0755, true);
            exec("mkdir -p $directory");
        }
    }

    /**
     * Remove a directory
     */
    protected function _removeDir($directory)
    {
        if (is_dir($directory)) {
            exec("rm -r $directory");
        }
    }

    /**
     * Connect to a database
     */
    protected function _connectDb()
    {
        if ($this->_db) {
            $this->_db = null;
        }

        try {
            $this->_db = new PDO(
                $this->_config['dbDsn'],
                $this->_config['dbUsername'],
                $this->_config['dbPassword']
            );
        }
        catch (PDOException $exception) {
            exit("Error: " . $exception->getMessage() . "\n");
        }

        $this->_db->beginTransaction();

        // MySQL charset workaround
        if (!empty($this->_config['dbCharset'])) {
            $this->_db->query('SET NAMES ' . $this->_config['dbCharset']);
        }
    }

    /**
     * Disconnect from a database
     */
    protected function _disconnectDb()
    {
        if ($this->_db) {
            $this->_db->commit();
            $this->_db = null;
        }
    }

    /**
     * Get and optimize a file content
     */
    protected function _getContents($filename)
    {
        $content = file_get_contents($filename);

        if (extension_loaded('mbstring')) {
            $content = mb_convert_encoding($content, $this->_config['encoding'], 'auto');
        }
        $content = str_replace(array("\r\n", "\r"), "\n", $content);

        return $content;
    }

    /**
     * Download and extract an archive file
     */
    protected function _downloadFile($downloadUri, $saveFilename)
    {
        // Try to download bz2 archive
        exec("wget $downloadUri.bz2 -O $saveFilename.bz2"
            . " --limit-rate={$this->_config['maxConnectionRate']}"
        );
        if (filesize("$saveFilename.bz2") > 1) {
            exec("bzip2 -d $saveFilename.bz2");
            return true;
        }
        unlink("$saveFilename.bz2");

        // Try to download gz archive
        exec("wget $downloadUri.gz -O $saveFilename.gz"
            . " --limit-rate={$this->_config['maxConnectionRate']}"
        );
        if (filesize("$saveFilename.gz") > 1) {
            exec("gzip -d $saveFilename.gz");
            return true;
        }
        unlink("$saveFilename.gz");

        // Try to download raw file
        exec("wget $downloadUri -O $saveFilename"
            . " --limit-rate={$this->_config['maxConnectionRate']}"
        );
        if (filesize($saveFilename) > 1) {
            return true;
        }
        unlink($saveFilename);

        return false;
    }

}

/**
 * Execute the setup
 */
$setup = new Setup(parse_ini_file(dirname(__FILE__) . '/setup.ini'));
$setup->execute();
