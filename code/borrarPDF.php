<?php

public function actionBorrar($id) {
        $modelos = $this->loadModel($id);

        if(count($modelos->Fotosimgs)>=1){
            for($i=0;$i <= (count($modelos->Fotosimgs)-1);$i++){
                $file = (substr($modelos->Fotosimgs[$i]->ruta, 1));
                $do = unlink($file);// unlink() borra el archivo
                $file = (substr($modelos->Fotosimgs[$i]->ruta2, 1));
                $do = unlink($file);
                $file = (substr($modelos->Fotosimgs[$i]->ruta3, 1));
                $do = unlink($file);
                Fotosimg::model()->findByPk($modelos->Fotosimgs[$i]->codigo)->delete();
            }
        }
        $modelos->delete();
        $this->redirect(array('/usuarios/perfil'));
    }

?>
