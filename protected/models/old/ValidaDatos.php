<?php


class ValidaDatos
{
    
    
    public static function validar($tipo, $valor)
    {
        $result = "";
        
        switch ($tipo)
        {
            case 'DATE':
                $result = self::validaFecha($valor);
                $result = ($result)? $result : null;
                break;
            case 'VARCHAR':
                $result = self::validaCadenas($valor);
                $result = ($result)? "{$result}" : "";
                break;
            case 'INTEGER':
                $result = self::validaEntero($valor);
                $result = ($result)? (int)$result : 0;
                break;
            case 'DECIMAL':
                $result = self::validaEntero($valor);
                $result = ($result)? (float)$result : 0.0;
                break;
            case 'URL':
                $result = self::validaUrl($valor);
                $result = ($result)? $valor : "";
                break;
        }
        
        return $result;
    }
    
    
    
    private function validaFecha($valor)
    {
        switch ($valor) {
            case null:
            case '':
                return false;
            break;
            default:
                return date("Y-m-d", strtotime($valor));
            break;
        }
    }
    
    
    private function validaUrl($valor)
    {
        // Remove all illegal characters from a url
        $url = filter_var($valor, FILTER_SANITIZE_URL);
        
        // Validate url
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return true;
        }
        
        return false;
    }
    
    
    private function validaCadenas($valor)
    {
        return filter_var($valor, FILTER_SANITIZE_STRING);
    }
    
    
    private function validaEntero($valor)
    {
        return filter_var($valor, FILTER_VALIDATE_INT);
    }
    
    
    private function validaDecimal($valor)
    {
        return filter_var($valor, FILTER_VALIDATE_FLOAT);
    }
}

