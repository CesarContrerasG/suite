<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Helpers extends Model
{
    public static function getListPaymentMethodsSAT()
    {
        $methods = [ 
            1 => "Efectivo",
            2 => "Cheque",
            3 => "Transferencia",
            4 => "Tarjetas de Crédito",
            5 => "Monederos electrónicos",
            6 => "Dinero electrónico",
            7 => "Tarjetas digitales",
            8 => "Vales de despensa", 
            9 => "Bienes",
            10 => "Servicio",
            11 => "Por cuenta de tercero",
            12 => "Dación de pago",
            13 => "Pago por subrogación",
            14 => "Pago por consignación",
            15 => "Condonación",
            16 => "Cancelación",
            17 => "Compensación",
            98 => "NA",
            99 => "Otros"
        ];

        return $methods;
    }

    public static function getNameMethodPaymentSAT($value)
    {
        $methods = Helpers::getListPaymentMethodsSAT();
        return $methods[$value];
    }

    public static function getListIconNivel()
    {
        $icons = [
            1 => "icon-command",
            2 => "icon-trophy",
            3 => "icon-user-tie",
            4 => "icon-headset_mic",
            5 => "icon-keyboard",
            6 => "icon-users",
            7 => "icon-eye-plus"
        ];

        return $icons;
    }

    public static function getIconNivel($value)
    {
        $icons = Helpers::getListIconNivel();
        $icon = $icons[$value];
        if($icon == "") {
            return "icon-flickr";
        }
        return $icon;
    }

    public static function getOficialsCatalogs()
    {
        $catalogs = [
            [
                "name" => "Apendice 01",
                "description" => "Aduana ~ Sección",
                "route" => "platform.catalog.oficial.apendice-01"
            ],
            [
                "name" => "Apendice 02",
                "description" => "Clave de Pedimento",
                "route" => "platform.catalog.oficial.apendice-02"
            ],
            [
                "name" => "Apendice 03",
                "description" => "Medios de Transporte",
                "route" => "platform.catalog.oficial.apendice-03"
            ],
            [
                "name" => "Apendice 04",
                "description" => "Clave de Paises",
                "route" => "platform.catalog.oficial.apendice-04"
            ],
            [
                "name" => "Apendice 05",
                "description" => "Clave de Monedas",
                "route" => "platform.catalog.oficial.apendice-05"
            ],
            [
                "name" => "Apendice 06",
                "description" => "Recintos Fiscalizados",
                "route" => "platform.catalog.oficial.apendice-06"
            ],
            [
                "name" => "Apendice 07",
                "description" => "Unidad de Medida",
                "route" => "platform.catalog.oficial.apendice-07"
            ],
            [
                "name" => "Apendice 08",
                "description" => "Identificadores",
                "route" => "platform.catalog.oficial.apendice-08"
            ],
            [
                "name" => "Apendice 09",
                "description" => "Regulaciones y Restricciones Arancelarias",
                "route" => "platform.catalog.oficial.apendice-09"
            ],
            [
                "name" => "Apendice 10",
                "description" => "Tipos de Contenedores y Vehiculos de Transporte",
                "route" => "platform.catalog.oficial.apendice-10"
            ],
            [
                "name" => "Apendice 11",
                "description" => "Claves de métodos de valoración",
                "route" => "platform.catalog.oficial.apendice-11"
            ],
            [
                "name" => "Apendice 12",
                "description" => "Contribuciones, Cuotas Compensatorias, Gravámenes y Derechos",
                "route" => "platform.catalog.oficial.apendice-12"
            ],
            [
                "name" => "Apendice 13",
                "description" => "Formas de Pago",
                "route" => "platform.catalog.oficial.apendice-13"
            ],
            [
                "name" => "Apendice 14",
                "description" => "Terminos de Facturación",
                "route" => "platform.catalog.oficial.apendice-14"
            ],
            [
                "name" => "Apendice 15",
                "description" => "Destinos de Mercancia",
                "route" => "platform.catalog.oficial.apendice-15"
            ],
            [
                "name" => "Apendice 16",
                "description" => "Regimenes",
                "route" => "platform.catalog.oficial.apendice-16"
            ],
            [
                "name" => "Apendice 17",
                "description" => "Pedimentos y Consolidados",
                "route" => "platform.catalog.oficial.apendice-17"
            ],
            [
                "name" => "Apendice 18",
                "description" => "Tipos de tasas",
                "route" => "platform.catalog.oficial.apendice-18"
            ],
            [
                "name" => "Apendice 19",
                "description" => "Clasificación de sustancias",
                "route" => "platform.catalog.oficial.apendice-19"
            ],
            [
                "name" => "Apendice 21",
                "description" => "Recintos fiscalizados y estrategicos",
                "route" => "platform.catalog.oficial.apendice-21"
            ],
            [
                "name" => "OMA",
                "description" => "Unidades de Medida",
                "route" => "platform.catalog.oficial.oma-unidades"
            ],
            [
                "name" => "OMA",
                "description" => "Claves de Moneda",
                "route" => "platform.catalog.oficial.oma-moneda"
            ],
            [
                "name" => "OMA",
                "description" => "Factor de Moneda Extranjera",
                "route" => "platform.catalog.oficial.oma-factor"
            ],
            [
                "name" => "OMA",
                "description" => "Tipo de Cambio",
                "route" => "platform.catalog.oficial.oma-cambio"
            ],
            [
                "name" => "OMA",
                "description" => "Indice Nacional del Precio al Cosumidor",
                "route" => "platform.catalog.oficial.oma-inpc"
            ],
            [
                "name" => "OMA",
                "description" => "Fracción Arancelaria",
                "route" => "platform.catalog.oficial.oma-fraccion"
            ]            
        ];

        return $catalogs;
    }
}
