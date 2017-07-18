<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }


    /**
     *
     * GÉRE LA CONSTRUCTION DU TABLEAU DATA DES NOTIFICATIONS EN FONCTION DE LEUR TYPE
     *
     * @param {String} $notification_type - type de la notification, permet de déterminer sa construction
     * @param {Array} $title - composantes du titre de la notification
     * @param {String} $icon - chemin de l'icône
     * @param {Array} $content - composante de la partie description de la notification
     * @param {Array} $action - tableau des paramètres de la fonction d'action
     * @return string
     */
    public static function jsonData($notification_type, $title, $icon, $content, $action){

        $data = [];

        //LIKE SUR UN POSTS
        if($notification_type == 'post_like'){
            $data = [
                'title' => $title[0] . ' à aimé(e) votre post sur ' . $title[1],
                'icon' => $icon,
                'content' => 'liké par <a href="' . $content[0] . '">' . $content[1] . '</a>',
                'action' => 'vuePost(' . $action[0] . ')'
            ];
        }


        //LIKE SUR UN COMMENTAIRE DE PREMIER NIVEAU
        if($notification_type == 'comment_like'){
            $data = [
                'title' => $title[0] . ' à aimé(e) votre commentaire sur ' . $title[1],
                'icon' => $icon,
                'content' => 'liké par <a href="' . $content[0] . '">' . $content[1] . '</a>',
                'action' => 'vuePost(' . $action[0] . ')'
            ];
        }


        //LIKE SUR UN COMMENTAIRE DE PREMIER NIVEAU
        if($notification_type == 'sub_comment_like'){
            $data = [
                'title' => $title[0] . ' à aimé(e) votre réponse sur ' . $title[1],
                'icon' => $icon,
                'content' => 'liké par <a href="' . $content[0] . '">' . $content[1] . '</a>',
                'action' => 'vuePost(' . $action[0] . ')'
            ];
        }


        //COMMENTAIRE SUR UN POST
        if($notification_type == 'new_post_comment'){
            $data = [
                'title' => $title[0] . ' à commenté(e) votre post sur ' . $title[1],
                'icon' => $icon,
                'content' => 'posté par <a href="' . $content[0] . '">' . $content[1] . '</a>',
                'action' => 'vuePost(' . $action[0] . ')'
            ];
        }

        return json_encode($data);
    }
}