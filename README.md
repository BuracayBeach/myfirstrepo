myfirstrepo
===========
ROUTING CHANGED FROM:
localhost/myfirstrepo/index.php/home/faq
---> localhost/myfirstrepo/faq

Instructions:
click wamp icon from taskbar
wamp > apache > apache modules > (check)rewrite_module

if still not working find the line below in httpd.conf file (wamp > apache > httpd.conf):
```
#
# AllowOverride controls what directives may be placed in .htaccess files.
# It can be "All", "None", or any combination of the keywords:
#   AllowOverride FileInfo AuthConfig Limit
#
AllowOverride
```


^ Change if AllowOverride is set to None, set to All
