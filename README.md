# eCommerce-TecWeb
eCommerce per il progetto di TecnologieWeb.
## INSTALLAZIONE:
- Installare Vagrant e Virtualbox
- Installare PHP e Composer
- Eseguire il comando ./vendor/bin/homestead make
- Modificare il file Homestead.yml opportunamente
- Aggiungere una riga nel file /etc/hosts che punti tecweb.test all'ip della macchina virtuale (prima riga di Homestead.yml)
- Copiare il file .env.example in .env
- Eseguire vagrant up per avviare la macchina
- Eseguire vagrant sshper entrare nella macchina
- Visitare l'indirizzo http://tecweb.test
- Per spegnere la macchina usare vagrant halt.
## LINTING
Per essere sicuri di aver scritto correttamente il codice (sia da un punto stilistico che da possibili errori logici), utilizzare i linter configurati.
- PHP: php-cs-fixer fix (Richiede l'installazione globale: composer global require friendsofphp/php-cs-fixer)
- Javascript: npm run eslint
