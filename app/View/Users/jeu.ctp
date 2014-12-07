
<script type="text/javascript">

    function refreshCode(){   
        $('#stats_joueurs').load( document.URL +' #stats_joueurs');
        
    }
 setInterval(function(){ refreshCode(); }, 1000)
 var interval = null;
    function refresh_nb_joueur_ok(){
        var rows = document.getElementById('stats_joueurs').getElementsByTagName('tr').length;
        
        if(rows == 5){
            alert("ok");
            clearInterval(interval);
            get_tas();
        }
    }
 interval = setInterval(function(){
     refresh_nb_joueur_ok();
 }, 1000)
 
 function get_tas(){
     $.ajax({
         
         url: "http://localhost:8000/cards/view_json #content",
         success: function(data){
             var div = $(data).find("#content").html();
             alert("pioche recup");
             var json_tab= JSON.parse(div);
                start_game(json_tab);
         }
     });
     
 }
 
 function start_game(pioche){
    distribue_carte_debut(pioche);
    get_carte_index(pioche, 4);
 }
 
 function distribue_carte_debut(pioche){
     var id_joueur = document.URL.substr(document.URL.lastIndexOf('/')+1);
     var num_carte_depart_joueur = id_joueur%4;
     set_nb_card_plus(id_joueur,pioche,num_carte_depart_joueur);
 }
 
function set_nb_card_plus(id_joueur,pioche,num_carte_depart_joueur){
     $.ajax({
         
         url: "http://localhost:8000/users/set_nb_card/"+id_joueur,
         success: function(){
             get_carte_index(pioche, num_carte_depart_joueur);
             
         }
     });
 }
 
 function get_carte_index(pioche, index){
     for(var i=0;i<pioche.length;i++){
           
        var obj = pioche[i];
        for(var key in obj['Card']){
            var attrName = key;
            var attrValue = obj['Card'][key];
            if(key !="id" && i==index){
                var img = document.createElement("img");
                img.src = '<?php echo $this->Html->url("/",true).'img/jeu/';?>'+attrValue+'.png';
                if(index<4){
                    var cont = document.getElementById("carte_joueur");
                    cont.appendChild(img);
                    img.onclick= function(e){
                        comparaison_carte_joueur(attrValue);
                    }
                }
                else{
                   var conts = document.getElementById("carte_pioche");
                   conts.appendChild(img);
                   img.onclick= function(e){
                       var id = document.URL.substr(document.URL.lastIndexOf('/')+1);
                        comparaison_carte_pioche(id, pioche, index);
                    }
                }
                
            }
            
        }
    }
 }
 
 function comparaison_carte_joueur(value){
    $(".img2")[0].innerHTML= value;
    alert("c'est fait");
    }
 
 function comparaion_carte_pioche(id,pioche,value){
     var valeur = value;
    var div =  $(".img2")[0].innerHTML;
    
    alert(div);
    if(div===""){
        alert("cliquez sur votre carte d'abord");
    }
    /*else{
        document.getElementById("img1").innerHTML= value;
        var div1 = document.getElementById("img1").innerHTML;
        if(div1===div){
            document.getElementById("resultat").innerHTML= "Bravo !";
            }
        else{
            document.getElementById("resultat").innerHTML= "Essaie encore !";
        }
    }*/
 }
 
</script>


<div id="stats_joueurs">
<table>
    <tr>
        <th>Joueur</th>
        <th>Nombre de Cartes</th>
    </tr>

<?php foreach($users as $user): ?>
    <tr>
        <td><?php echo $user['User']['name']; ?></td>
        <td>
            <?php echo $user['User']['nbCards']; ?>
        </td>
    </tr>
 <?php    endforeach; ?>
<?php unset($user); ?>
</table>
    
</div>

<div id="carte_pioche">
    en attente d'autre joueurs
</div>

<div id="carte_joueur">
</div>

<div class="comparaison">
    <div class="img1"></div>
    <div class="img2"></div>
    <div class="resultat"></div>
</div>
