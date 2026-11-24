#!/bin/bash
# Restore LensHub to a clean state after you've defaced it.
cd "$(dirname "$0")"
cp index.php.bak index.php
# remove any uploaded shells/images except the 3 defaults
find uploads -type f ! -name 'featured.jpg' ! -name 'street.jpg' ! -name 'portrait.jpg' -delete
echo "[+] LensHub reset: index.php restored, uploads cleaned."
