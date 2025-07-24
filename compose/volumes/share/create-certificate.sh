cd ./certificate
rm -rf certificate.crt
rm -rf private.key
openssl genrsa -out private.key 2048
openssl req -x509 -newkey rsa:2048 -keyout private.key -out certificate.crt -days 365 -nodes \
-subj "/C=DE/ST=Niedersachsen/L=Celle/O=shaack.com/OU=IT/CN=localhost"
