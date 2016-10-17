<?php 
function elh_insert_into_db() {
    
    global $wpdb;
    $current_user = wp_get_current_user();
    $username = $current_user->user_login;
    $user_id = get_current_user_id();
    // creates ayuda_table in database if not exists
    $table = $wpdb->prefix . "ayuda_table"; 
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        `id` mediumint(9) NOT NULL AUTO_INCREMENT,
        `id_name` mediumint(9) NOT NULL ,
        `name` text NOT NULL,
        `aviso` boolean NULL,
        `material` boolean NULL,
    UNIQUE (`id`)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    // starts output buffering
    ob_start();
    ?>
    <form action="#v_form" method="post" id="v_form">
        <input type="hidden" name="visitor_name" id="visitor_name" value="<?php echo $username; ?>" />
        <input type="hidden" name="id_name" id="id_name" value="<?php echo $user_id; ?>" />
        <label for="aviso">Quiero que me avisen cuando haya campañas</label>
        <input type="checkbox" name="aviso" id="aviso" />
        <label for="aviso">Quiero material impreso para difundir</label>
        <input type="checkbox" name="material" id="material" />
        <input type="submit" name="submit_form" value="enviar" />
    </form>
    <?php
    $html = ob_get_clean();
    // does the inserting, in case the form is filled and submitted
    if ( isset( $_POST["submit_form"] ) && $_POST["visitor_name"] != "" ) {
        $table = $wpdb->prefix."ayuda_table";
        $name = strip_tags($_POST["visitor_name"], "");
        $id_name = $_POST["id_name"];
        $aviso = (isset($_POST['aviso'])) ? 1 : 0;
        $material = (isset($_POST['material'])) ? 1 : 0;
        $wpdb->insert( 
            $table, 
            array( 
                'name' => $name,
                'id_name' => $id_name,
                'aviso' => $aviso,
                'material' => $material
            )
        );
        $html = "<p>Gracias <strong>$name</strong> tu mensaje fue enviado.</p>";
    }
    // if the form is submitted but the name is empty
    if ( isset( $_POST["submit_form"] ) && $_POST["visitor_name"] == "" )
        $html .= "<p>You need to fill the required fields.</p>";
    // outputs everything
    return $html;
     
}
// adds a shortcode you can use: [insert-into-db]
add_shortcode('quiero-ayudar', 'elh_insert_into_db');