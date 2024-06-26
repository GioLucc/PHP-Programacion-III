<?php
class ConsultarVentas
{
    public static function ObtenerVentasPorFecha($fecha, $archivo)
    {
        if (file_exists($archivo)) {
            $fechaActual = new DateTime();
            $fechaActual->modify('-1 day');
            $fechaDeAyer = $fechaActual->format('d-m-Y');
            $ventasDeLaFecha = array();

            $jsonString = json_decode(file_get_contents($archivo), true);

            if (!empty($fecha)) {
                var_dump("Fecha no vacia");
                foreach ($jsonString as $ventas) {
                    if ($ventas['fecha'] == $fecha) {
                        array_push($ventasDeLaFecha, $ventas);
                    }
                }
            } else {
                var_dump("Fecha vacia");
                foreach ($jsonString as $ventas) {
                    if ($ventas['fecha'] == $fechaDeAyer) {
                        array_push($ventasDeLaFecha, $ventas);
                    }
                }
            }

            return $ventasDeLaFecha;
        }
    }

    public static function ObtenerVentasPorUsuario($usuario, $archivo)
    {
        if (file_exists($archivo)) {
            $ventasDeUsuario = array();

            $jsonString = json_decode(file_get_contents($archivo), true);

            foreach ($jsonString as $ventas) {
                if ($ventas['usuario'] == $usuario) {
                    array_push($ventasDeUsuario, $ventas);
                }
            }

            return $ventasDeUsuario;
        }
    }
    public static function ObtenerVentasPorVaso($vaso, $archivo)
    {
        if (file_exists($archivo)) {
            $ventasDeUsuario = array();

            $jsonString = json_decode(file_get_contents($archivo), true);

            foreach ($jsonString as $ventas) {
                if ($ventas['vaso'] == $vaso) {
                    array_push($ventasDeUsuario, $ventas);
                }
            }

            return $ventasDeUsuario;
        }
    }
    public static function ObtenerVentasPorSabor($sabor, $archivo)
    {
        if (file_exists($archivo)) {
            $ventasDeUsuario = array();

            $jsonString = json_decode(file_get_contents($archivo), true);

            foreach ($jsonString as $ventas) {
                if ($ventas['sabor'] == $sabor) {
                    array_push($ventasDeUsuario, $ventas);
                }
            }

            return $ventasDeUsuario;
        }
    }

    public static function ObtenerVentasPorFechasOrdenadasNombre($fechaUno,$fechaDos,$archivo)
    {
        if (file_exists($archivo)) {
            $ventasDeLaFecha = array();
            $jsonString = json_decode(file_get_contents($archivo), true);

            if (!empty($fechaUno) && !empty($fechaDos)) 
            {
                require_once 'Utilidades.php';
                foreach ($jsonString as $ventas) {
                    if (Utilidades::estaEnRangoDeFechas($ventas['fecha'],$fechaUno,$fechaDos))
                    {
                        array_push($ventasDeLaFecha, $ventas);
                    }
                }
            }

            usort($ventasDeLaFecha, function($a, $b) {
                return strcmp($a['usuario'], $b['usuario']);
            });

            return $ventasDeLaFecha;
        }
    }
}
