# Stellar php-federation
this is a simple php federation server that can be use with any existing database

create a folder in your public_html eg fed
add the index.php file in the fed folder
in your /.well-known/stellar.toml file add the line FEDERATION_SERVER="https://sitename.com/fed/" 
eg : https://www.tonaira.com/.well-known/stellar.toml 

add your wallet address and federation id to your mysql .

also do not forget to add access origin to for CORS.


example of a result is : https://tonaira.com/fed/?q=ngn*tonaira.com&type=name
