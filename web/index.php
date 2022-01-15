<?php

    include_once '../lib/helpers.php';
    include_once '../view/partials/header.php';
    
        //include_once '../view/facturas/prueba_factura.php';
        if (isset($_GET['modulo'])) {
            resolve();
        }else{
            redirect(getUrl('Form','Form','home'));
        }

    include_once '../view/partials/footer.php';
