
<script type="text/javascript">
    function refreshCode(){   
        $('#stats_joueurs').load( document.URL +' #stats_joueurs');
    }
 setInterval(function(){ refreshCode(); }, 1000)
 var interval = null;
    function refresh_nb_joueur_ok(){
        var rows = document.getElementById('stats_joueurs').getElementsByTagName('tr').length;
        if(rows == 5){
            clearInterval(interval);
            var pioche = get_tas();
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
             var json_tab= JSON.parse(div);
                start_game(json_tab);
         }
     });
 }
 
 function start_game(pioche){
    distribue_carte_debut(pioche);
    affichage_carte_pioche(pioche);
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
             var symbols = get_carte_index(pioche, num_carte_depart_joueur);
             document.getElementById('carte_joueur').innerHTML = symbols;
             
         }
     });
 }
 
 function affichage_carte_pioche(pioche){
     var pathArray = document.URL.split( '/' );
     $.ajax({
         
         url: "http://localhost:8000/games/get_indx/"+pathArray[5],
         success: function(data){
             var index = $(data).find("#content").html();
             var carte = get_carte_index(pioche,index);
             document.getElementById('carte_pioche').innerHTML = carte;
             
         }
     });
 }
 
 function get_carte_index(pioche, index){
     var symbols='';
     for(var i=0;i<pioche.length;i++){
           
        var obj = pioche[i];
        for(var key in obj['Card']){
            var attrName = key;
            var attrValue = obj['Card'][key];
            if(key !="id" && i==index){
                if(index<4){
                    symbols+=" "+"<img src='<?php echo $this->Html->url("/",true).'img/jeu/';?>"+attrValue+".png' onclick='comparaison_carte_joueur("+attrValue+")'/>";
                }
                else{
                    symbols+=" "+"<img src='<?php echo $this->Html->url("/",true).'img/jeu/';?>"+attrValue+".png' onclick='comparaison_pioche("+attrValue+")'/>";
                }
                
            }
            
        }
    }
    return symbols;
 }
 
 function comparaison_pioche(value){
    document.getElementById('resultat').innerHTML = "";
    var div1 = document.getElementById('img1').innerHTML;
    if(div1===""){
        
        document.getElementById('img1').innerHTML = value;
        div1 = document.getElementById('img1').innerHTML;
        var div2 = document.getElementById('img2').innerHTML;
        if(div2 === ""){
            
        }else{
            if(div1===div2){
                document.getElementById('resultat').innerHTML = "Bravo !";
                document.getElementById('img1').innerHTML = "";
                document.getElementById('img2').innerHTML = "";
            }else{
                document.getElementById('resultat').innerHTML = "Essaie Encore !";
                document.getElementById('img1').innerHTML = "";
                document.getElementById('img2').innerHTML = "";
            }
        }
    }
    else{
        document.getElementById('img1').innerHTML = value;
        
    }
 }
 
 function comparaison_carte_joueur(value){
     document.getElementById('resultat').innerHTML = "";
      var div1 = document.getElementById('img2').innerHTML;
    if(div1===""){
        
        document.getElementById('img2').innerHTML = value;
        div1 = document.getElementById('img2').innerHTML;
        var div2 = document.getElementById('img1').innerHTML;
        if(div2 === ""){
            
        }else{
            
            if(div1===div2){
                document.getElementById('resultat').innerHTML = "Bravo !";
                document.getElementById('img1').innerHTML = "";
                document.getElementById('img2').innerHTML = "";
                
            }else{
                document.getElementById('resultat').innerHTML = "Essaie Encore !";
                document.getElementById('img1').innerHTML = "";
                document.getElementById('img2').innerHTML = "";
            }
        }
    }
    else{
        document.getElementById('img2').innerHTML = value;
        
    }
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

<div id="comparaison">
    <div id="img1"></div>
    <div id="img2"></div>
    <div id="resultat"></div>
</div>
