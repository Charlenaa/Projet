<?php
$mdp=password_hash('WMK',PASSWORD_DEFAULT);
if(password_verify('WMK','$2y$10$fnAtmEjCkpAzCRTueUtJBecBW5F3sSy8VUf/17CZa2Tn9GaValutC')){
    echo 'bon <br>';
    echo $mdp;
    echo '<br> $2y$10$fnAtmEjCkpAzCRTueUtJBecBW5F3sSy8VUf/17CZa2Tn9GaValutC';
}
else{
    echo 'pas bon';
}