#!/bin/bash
# may required to run as root, sometimes.
#Sun, 18 Mar 2012 01:31:01 +0530 
#ruwan800@gmail.com
#This software creates directories for the repository and generates package file.
#This software also edit the sources list and update the package list.
#Repository will be created in "/var/www/repo/"; just edit 'repoDir' to change it.

clear
echo "     ============ Debian test repository creating utility =============     "
repoDir="/var/www/repo"
codeName=$(lsb_release -sc)
userID=$(id -u)
if [ $userID -ne 0 ]
then    
	echo "\nThis script must be run as root."
else
	if [ ! -e "$repoDir/dists/$codeName/test/binary-i386" ]       # Check if file exists.
	then
		mkdir -pv $repoDir/dists/$codeName/test/binary-i386
		mkdir -pv $repoDir/pool/test
		chmod -R 775 $repoDir/
		echo "\nPut selected *.deb packages in '/var/www/repo/pool/test' directory and run this script again."
	else
		cd $repoDir
		command -v dpkg-scanpackages >/dev/null 2>&1 || { echo "Installing dpkg-dev";sudo apt-get install dpkg-dev >&2; }
		dpkg-scanpackages pool/test /dev/null | gzip -9c > dists/oneiric/test/binary-i386/Packages.gz
		tempVar=$(grep -c "##Test repository for VOS management portal" /etc/apt/sources.list)
		if [ $tempVar -eq 0 ]
		then
			echo "\n##Test repository for VOS management portal" >> /etc/apt/sources.list
			echo "deb http://localhost/repo $codeName test" >> /etc/apt/sources.list
			echo "Sources list updated."
		fi
		apt-get update
		echo "Debian test repository sucessfully created."
	fi
fi
