<?php

/**
 */
class PreguntasValidacion 
{    
    
    
    public function validarPreguntas($post)
    {
        
        //
        $a = 1;
        $valorComparacion = $this->patronValidacion()[$post['action']];
        $valorComparado = $post['UsrDeudas'];
        //var_dump($valorComparacion);die;
        for($i=0; $i<5; $i++)
        {
            if(isset($valorComparado['respuesta'.$a]))
            {
                //die("Comparacion".$valorComparacion[$i]."  Comparado".$valorComparado['respuesta'.$a]);
                if($valorComparacion[$i] == $valorComparado['respuesta'.$a])
                {
                    //var_dump($valorComparacion[$i]);var_dump($valorComparado['respuesta'.$a]);die;
                    if($a == 5)
                    {
                        $model = new UsrUsuariosSistema;
                        $row = $model->find(array('condition'=>'id_user = '. Yii::app()->user->id ));
                        //var_dump($row);
                        $row->pass2 = $row->pass;
                        $row->validar_pregunta = 0;
                        if($row->save())
                        {
                            Yii::app()->user->setState('validar', null);
                            Yii::app()->user->setState('validar', 0);
                            return true;
                        }
                        
                        $errores = CHtml::errorSummary($row);
                        throw new Exception($errores);
                        
                    }
                    
                }
                else
                {
                    throw new Exception('No se ha podido demostrar su identidad, por favor intente responder las preguntas luego.');
                }
                
            }
            else
            {
                throw new Exception('Debe responder todas las preguntas para completar la validación de su identidad');
            }
            
            
            $a++;
        }
    }
    
    
    private function patronValidacion()
    {
        return array(
            '1'=>array(0=>3,1=>5,2=>2,3=>4,4=>3),
            '2'=>array(0=>2,1=>5,2=>4,3=>3,4=>1)
        );
    }
}