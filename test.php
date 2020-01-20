<?php
/**
 * Plugin Name: Product Vue
 * Description: Woocommerce Product Page Development.
 * Author: Niloy Quazi
 * Author URI: #
 */

//Register scripts to use
function func_load_vuescripts()
{
    wp_register_script('wpvue_vuejs', 'https://cdn.jsdelivr.net/npm/vue/dist/vue.js');
    wp_register_script('my_vuecode', plugin_dir_url(__FILE__).'vuecode.js', 'wpvue_vuejs', true);
}
//Tell WordPress to register the scripts
add_action('wp_enqueue_scripts', 'func_load_vuescripts');


function func_style()
{
    wp_register_style('wpvue_style', plugin_dir_url(__FILE__).'/assets/css/bulma.min.css');
    wp_register_style('my_style', plugin_dir_url(__FILE__).'vuecode.js', 'wpvue_style', true);
}

add_action('wp_enqueue_scripts', 'func_style');


//Return string for shortcode
function func_wp_vue()
{
    //Add Vue.js
    wp_enqueue_script('wpvue_vuejs');
    //Add my code to it
    wp_enqueue_script('my_vuecode');


    wp_enqueue_style('wpvue_style');
    wp_enqueue_style('my_style');


    $sale_price = get_post_meta(get_the_ID(), '_sale_price', true);

    //Build String
    echo "<div id='divWpVue'>"
    .'<calc></calc>'
    .'<br>'
    .'
          <p>Select any personalization type</p>
        <tabs>
            <tab name="Insert Text" :selected="true">
                <div>
                    Text (max. 40 characters per line)
                    <div class="field">
                        <div class="control">
                            <input class="input is-primary" type="text" name="" placeholder="Row 1">
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <input class="input is-primary" type="text" name="" placeholder="Row 2">
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <input v-model="row_three" class="input is-primary" type="text" name="" placeholder="Row 3">
                        </div>
                    </div>

                    <modal v-if="showModal" @close="showModal=false">
                      {{row_three}}
                      <img src="https://www.ic-myron.com/cf/HybrisProd/ConfigExpress/PreviewImageCalc/StreamView.cfm?comp=AU&qsn=K12009788&itemno=WF98803A&AreaPhyG=PBF&FontID=MYRONDR&logo=&impline1=.&impline2=&impline3=&AutoCalculateFontSizeForPreview=Y">
                    </modal>

                    <button @click="showModal=true">Preview</button>
                </div>
            </tab>

            <tab name="Insert Logo">
                <div>
                  Farbe/Methode: einfarbiger Aufdruck

                  <div class="file">
                    <input type="file" name="resume">
                  </div>

                  <h4><b class="has-text-centered">ODER</b></h4>

                  <p>
                    <h5>Später Senden - </h5>

                   Ihre Personalisierungswünsche können Sie nach Abschluss Ihrer Bestellung einreichen. Gerne können Sie uns Ihre Personalisierungswünsche und/oder Ihre Druckvorlage separat per E-Mail an logo@example.com senden. Bei Fragen hilft Ihnen unser Kundenservice gerne telefonisch unter 0681 99 25 450 weiter. Erst nach finaler Freigabe Ihrerseits wird Ihr Auftrag produziert.
                   </p>

                    <div class="field">
                       <label class="label" for="">Anmerkungen :</label>
                       <div class="control">
                           <textarea class="textarea is-primary" name="" placeholder=""></textarea>
                       </div>
                   </div>

                </div>
            </tab>

        </tabs>


    '
    .'<br>'
    .'</div>';

    //Return to display
    // return $display;
}

//Add shortcode to WordPress
// add_shortcode('wpvue', 'func_wp_vue');

add_action('woocommerce_before_add_to_cart_form', 'func_wp_vue');



/////
// remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);

function testing()
{
    return '100';
}

add_filter('woocommerce_cart_item_price', 'testing');
