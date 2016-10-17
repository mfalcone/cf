<?php 
function mapeo_insert_into_db() {
    
    global $wpdb;
    $current_user = wp_get_current_user();
    $username = $current_user->user_login;
    $user_id = get_current_user_id();
    // creates ayuda_table in database if not exists
    $table = $wpdb->prefix . "mapeo_table"; 
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        `id` mediumint(9) NOT NULL AUTO_INCREMENT,
        `id_name` mediumint(9) NOT NULL ,
         `name` text  NULL,
        `lat` text  NULL,
        `lng` text  NULL,
         `direccion` text  NULL,
       
    UNIQUE (`id`)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    // starts output buffering
    ob_start();
    ?>
    
    <form action="#map_form" method="post" id="map_form">
        <div id="quiero-mapeo"></div>
        <input type="text" name="direccion" id="direccion" />
        <input type="hidden" name="visitor_name" id="visitor_name" value="<?php echo $username; ?>" />
        <input type="hidden" name="id_name" id="id_name" value="<?php echo $user_id; ?>" />
        <input type="hidden" name="lat" id="lat" value="" />
        <input type="hidden" name="lng" id="lng" value="" />
         <input type="submit" name="submit_form" value="enviar" />
    </form>
    <?php
    $html = ob_get_clean();
    // does the inserting, in case the form is filled and submitted
    if ( isset( $_POST["submit_form"] ) && $_POST["lat"] != "" && $_POST["lng"] != ""  && $_POST["direccion"] != "") {
        $table = $wpdb->prefix."mapeo_table";
        $name = strip_tags($_POST["visitor_name"], "");
        $direccion = strip_tags($_POST["direccion"], "");
        $id_name = $_POST["id_name"];
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];
        
        $wpdb->insert( 
            $table, 
            array( 
                'id_name' => $id_name,
                 'name' => $name,
               'lat' => $lat,
                'lng' => $lng,
                'direccion' => $direccion,
            )
        );
        print_r($name);
        print_r($id_name);
        print_r($lat);
        print_r($lng);
        print_r($direccion);
        $html = "<p>Gracias <strong>$name</strong> tu mensaje fue enviado.</p>";
    }
    // if the form is submitted but the name is empty
    if ( isset( $_POST["submit_form"] ) && $_POST["lat"] == "" )
        $html .= "<p>Por favor, indicá la ubicación en el mapa.</p>";
    // outputs everything
    return $html;
     
}
// adds a shortcode you can use: [insert-into-db]
add_shortcode('quiero-mapeo', 'mapeo_insert_into_db');