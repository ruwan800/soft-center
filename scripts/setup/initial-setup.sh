#!/bin/bash

# Batch script to initial setup

# Usage
#
# sh initial-setup.sh

# Configuration options
distro='precise'
temp_dir='../../temp'
temp_icons_dir='../../temp/icons-original'

# Change current working directory
cd `dirname $0`

# Confirmation to initial setup
echo ''
echo 'Confirmation:'
echo 'This is a batch script to initial setup.'
echo 'Do you really want to start the initial setup? (Y/N) > '

read confirm
if [ $confirm = 'Y' ] || [ $confirm = 'y' ]
then
    echo ''
    echo 'Starting the initial setup...'
    echo ''
else
    echo ''
    echo 'Bye!'
    echo ''
    exit
fi

# Download and extract source files
php setup.php get-repository "deb http://archive.ubuntu.com/ubuntu/ $distro main restricted multiverse universe"

php setup.php get-appinstalldata bzr

php setup.php get-popcon by_inst

# Copy the downloaded icons
mkdir -p $temp_icons_dir
cp $temp_dir/app-install-data/app-install-data-ubuntu/*/icons/* $temp_icons_dir

# Create database tables
php setup.php create-tables

# Import the data into database
for component in main restricted multiverse universe
do
    php setup.php import-packages "$temp_dir/repositories/archive.ubuntu.com/ubuntu/dists/$distro/$component/binary-i386/Packages" 'http://archive.ubuntu.com/ubuntu/' $distro $component
    for lang in en uk
    do
        php setup.php import-translation "$temp_dir/repositories/archive.ubuntu.com/ubuntu/dists/$distro/$component/i18n/Translation-$lang" 'http://archive.ubuntu.com/ubuntu/' $distro $component $lang
    done
done

php setup.php import-desktopentries "$temp_dir/app-install-data/app-install-data-ubuntu/menu-data" $temp_icons_dir 'ubuntu-menu-data'
php setup.php import-desktopentries "$temp_dir/app-install-data/app-install-data-ubuntu/menu-data-additional" $temp_icons_dir 'ubuntu-menu-data-additional' 'Additional'
php setup.php import-desktopentries "$temp_dir/app-install-data/app-install-data-ubuntu/menu-data-codecs" $temp_icons_dir 'ubuntu-menu-data-codecs' 'Codecs'
php setup.php import-desktopentries "$temp_dir/app-install-data/app-install-data-ubuntu/menu-data-xul-extensions" $temp_icons_dir 'ubuntu-menu-data-xul-extensions' 'XUL-Extensions'

php setup.php import-popcon "$temp_dir/popcon/by_inst"

# Convert the icons
php setup.php convert-icons $temp_icons_dir small
php setup.php convert-icons $temp_icons_dir medium
php setup.php convert-icons $temp_icons_dir large

# Confirmation to additional setup
echo ''
echo 'Confirmation:'
echo 'You can continue to additional setup'
echo 'for recommended third-party softwares.'
echo 'Do you want to the additional setup? (Y/N) > '

read confirm
if [ $confirm = 'Y' ] || [ $confirm = 'y' ]
then
    echo ''
    echo 'Starting the additional setup...'
    echo ''
else
    echo ''
    echo 'Setup Done!'
    echo ''
    exit
fi

# Download and extract a source files
#php setup.php get-repository "deb http://extras.ubuntu.com/ubuntu/ $distro main"
php setup.php get-repository "deb http://archive.canonical.com/ubuntu/ $distro partner"
php setup.php get-repository "deb http://packages.medibuntu.org/ $distro free non-free"
#php setup.php get-repository "deb http://archive.getdeb.net/ubuntu/ $distro-getdeb apps"
php setup.php get-repository 'deb http://dl.google.com/linux/deb/ stable non-free main'
php setup.php get-repository 'deb http://deb.opera.com/opera/ stable non-free'
php setup.php get-repository 'deb http://download.skype.com/linux/repos/debian/ stable non-free'

# Import the data into database
#php setup.php import-packages "$temp_dir/repositories/extras.ubuntu.com/ubuntu/dists/$distro/main/binary-i386/Packages" 'http://extras.ubuntu.com/ubuntu/' $distro main
php setup.php import-packages "$temp_dir/repositories/archive.canonical.com/ubuntu/dists/$distro/partner/binary-i386/Packages" 'http://archive.canonical.com/ubuntu/' $distro partner
php setup.php import-packages "$temp_dir/repositories/packages.medibuntu.org/dists/$distro/free/binary-i386/Packages" 'http://packages.medibuntu.org/' $distro free
php setup.php import-packages "$temp_dir/repositories/packages.medibuntu.org/dists/$distro/non-free/binary-i386/Packages" 'http://packages.medibuntu.org/' $distro non-free
#php setup.php import-packages "$temp_dir/repositories/archive.getdeb.net/ubuntu/dists/$distro-getdeb/apps/binary-i386/Packages" 'http://archive.getdeb.net/ubuntu/' "$distro-getdeb" apps
php setup.php import-packages "$temp_dir/repositories/dl.google.com/linux/deb/dists/stable/non-free/binary-i386/Packages" 'http://dl.google.com/linux/deb/' stable non-free
php setup.php import-packages "$temp_dir/repositories/dl.google.com/linux/deb/dists/stable/main/binary-i386/Packages" 'http://dl.google.com/linux/deb/' stable main
php setup.php import-packages "$temp_dir/repositories/deb.opera.com/opera/dists/stable/non-free/binary-i386/Packages" 'http://deb.opera.com/opera/' stable non-free
php setup.php import-packages "$temp_dir/repositories/download.skype.com/linux/repos/debian/dists/stable/non-free/binary-i386/Packages" 'http://download.skype.com/linux/repos/debian/' stable non-free

# Setup ends
echo ''
echo 'Setup Done!'
echo ''
