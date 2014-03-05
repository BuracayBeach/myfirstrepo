#!/bin/bash

# Job Scheduler script for notification overdue checking
# Contact BurnzZ for more info

# requirements: php.exe

# ------ for UNIX systems ------
#
# -- manual overdue checking command:
#
# php index.php Notifs_Cron check_overdue
#
# -- cron job for 12:00AM checking everyday
#
# 0 * * * * php index.php Notifs_Cron check_overdue 

# ------ for DOS systems -------
#
# AT 00:00 php index.php Notifs_Cron check_overdue
