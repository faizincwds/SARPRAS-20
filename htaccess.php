<IfModule mod_rewrite.c>
RewriteEngine on
RewriteRule ^beranda index.php?p=beranda [NC,L]
RewriteRule ^forget index.php?p=forget [NC,L]
RewriteRule ^logout index.php?p=logout [NC,L]
RewriteRule ^contact index.php?p=contact [NC,L]

</IfModule>