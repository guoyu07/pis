#!/bin/bash
__NOW__=$( date )
__DIR__=$( cd `dirname ${BASH_SOURCE[0]}` && pwd )
/usr/bin/mysqldump -uwork -pwork pis > $__DIR__/pis.sql

cd $__DIR__
git add pis.sql
git commit -m "Backup database at: $__NOW__"
git push