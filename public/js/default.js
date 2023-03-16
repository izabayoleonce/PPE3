$(function(){
  let password = $('#staticPassword').val()
  let repet = $('#inputRepet').val()
  let letter = $('#letter')
  let capital = $('#capital')
  let number = $('#number')
  let lenght = $('#lenght') 
    $('#verify').on('click',function() {
      let mail=$('#staticEmail').val()
      let regx = /(^[a-zA-Z0-9_.]+[@]{1}[a-z0-9]+[\.][a-z]+$)/mg
      let login=$('#inputLogin').val()
      let mailAcccept = regx.test(mail)
      let password = $('#staticPassword').val()
      let repet = $('#inputRepet').val()
      //   console.log(mailAcccept)
      let strResult = ''
      // let base = ''
      // let xmlHttp = new XMLHttpRequest()
      // xmlHttp.open( "GET" ) // false for synchronous request
      // xmlHttp.send( null )
      // let http = String(xmlHttp.statusText)
      // console.log(xmlHttp)
    
      if(mailAcccept === true ){
        $.ajax({
          url: '?controller=utilisateur&action=verifyMailEndLogin',
          method: 'post',
          data:{
            email: mail,
            login: login
          },
          success: function( result, status, xhr ) {
            // console.log(xhr)
            let strResult=''
            let btnSet=''
            // console.log(result)

            if ( result== true ) {
              strResult='<!-- password --><div class="mb-3 row"><label for="staticPassword" class="col-sm-2 col-form-label">mot de passe</label><div class="col-sm-10"><input type="password"  class="form-control" id="staticPassword" value="" placeholder="mot de passe" name="password"></div></div><!-- repet password --><div class="mb-3 row"><label for="inputRepet" class="col-sm-2 col-form-label" >repetez</label><div class="col-sm-10"><input type="password" class="form-control" value="" name="Repassword" id="inputRepet"></div></div>'
              strResult +='<!-- message --><div class="mb-3 row"><div class="col-sm-10" id="messagePass"><h3> le mot de passe doit contenir les élements suivants</h3> <p id="letter" class="invalide"> une letter miniscule</p><p id="capital" class="invalide"> une letter majuscule</p><p id="number" class="invalide">un chiffre</p><p id="lenght" class="invalide">8 caractère minimun</p></div> <div class="col-sm-10" id="message"></div></div>'
              btnSet='<button class="btn btn-primary"  data-bs-toggle="modal" data-bs-dismiss="modal" type="button" id="change">changer</button>'
            }
            else{
              strResult='<div class="mb-3 row"><label for="staticEmail" class="col-sm-2 col-form-label">email</label><div class="col-sm-10"><input type="email"  class="form-control" id="staticEmail" value="" placeholder="email@example.com"></div></div><div class="mb-3 row"><label for="inputLogin" class="col-sm-2 col-form-label" >login</label><div class="col-sm-10"><input type="text" class="form-control" id="inputLogin"></div></div><div class="mb-3 row"><div class="col-sm-10" id="message"><p class="text-warning text-center">Ce compte n\'existe pas </p></div></div><div class="mb-3 row"><div class="col-sm-10"><button type="button" role="button" class="btn btn-secondary" id="verify"> Reverifier</button></div></div>'
            }
            $('#modal-body').html(strResult)
            $('#modal-footer').html(btnSet)
          },

        })

      }else{
        strResult += '<p class="text-danger text-center">insert un mail qui exist</p>'
        $('#message').html(strResult)
      }
    })

    $('#staticPassword').focus(function(){
      $('#messagePass').css( "display", "block")  
    })
  
    $('#staticPassword').blur(function(){
      $('#messagePass').css( "display", "none")  
    })


    $('#newType').on('click', function() {
      newstr='<li><form action="?controller=typeContenu&action=create" method="post"><input type="text" name="type" value="" id="typeInsert" /><button type="submit" class="btn btn-primary" id="okType">OK</button></form></li>'
      let add = $('#newType').before(newstr)
    })

    $("#okType").on('click',function () {
      console.log($('#typeInsert').val())      
      console.log["ça marcrhe"]
      
    })
    /**
     * affichage formulaire de creation de contenu
     * 
     * @returns string
     */
    $("#typeContenu").on('change',function () {
      let valeur = ''
      let str = ''
      let title=''
      let textType = ''
      let valSelect =''
      let defaultval = $( "select option:selected" ).val()
      if (defaultval !=-1) {
        $( "select option:selected" ).each(function() {
          valeur = $( this ).val()
          // $( this ).val("")
        });
        console.log(valeur)
        switch (valeur) {
          case "1":
            valSelect = $( "select option:selected" ).val(valeur)
            // console.log(valSelect)
            str += '<input class="inpBorder" type="file" name="imgContenu" class="img-fluid rounded-start inpBorder form-control-file" id="imgContenu"/>'
            title += '<input type="text" value="" name="nom" id="nom" placeholder="titre" class="inpBordern form-control contenu"/>'
            textType += ''
            console.log("photo")
            $("#photo").html(str)
            $("#link-file").html(textType)
            $("#contenu").html("")
            $("#titre").html(title)
            break;
          case "2":
            valSelect = $( "select option:selected" ).val(valeur)
            // console.log(valSelect)
            str += ' <input type="text" value="" name="contenu" id="contenu" placeholder="titre" class="inpBordern form-control contenu"/>'
            console.log("titre")
            $("#contenu").html(str)
            $("link-file").html("")
            $("#lien").html("")
            $("#photo").html("")
            break;
          case "3":
            valSelect = $( "select option:selected" ).val(valeur)
            // console.log(valSelect)
            str += '<textarea class="inpBordern form-control contenu" placeholder="contenu" id="contenu" style="height: 100px"></textarea>'
            console.log("contenu")
            $("#contenu").html(str)
            $("link-file").html("")
            $("#lien").html("")
            $("#photo").html("")
            break;
          case "4":
            $( "select option:selected" ).val(valeur)
            str += ' <input type="text" value="" name="contenu" id="contenu" placeholder="lien du contenu" class="inpBordern form-control contenu"/>'
            console.log("lien")
            $("#contenu").html("")
            $("link-file").html("")
            $("#lien").html(str)
            $("#photo").html("")
            break;
  
          default:
            $("#contenu").html("")
            $("link-file").html("")
            $("#lien").html("")
            $("#photo").html("")
            break;
        }
      }
    })

    $("#change").on("click", () =>{
      console.log("ok")
    })

    $('#imgContenu').select(function(){
      console.log($('#imgContenu').files)
    })

    /**
     * insert content 
     * 
     * @returns bool
     */
      $('#insert').on('click', function(){
        let type = $('select option:selected').select().val();
        let content = '';
        let str = '';
        let name = $('#nom').val();
        let date = $('#date').val();
        let page = $('#page').val();
        let formData = new FormData();
        if ($('#imgContenu').length) {
          if ($('#imgContenu').select()) {
            content += formData.append('contenu', $('#imgContenu')[0].files[0]);
          }
        }else{
          content += formData.append('contenu', $('.contenu').val());
        }
        formData.append('nom', name);
        formData.append('date', date);
        formData.append('type', type);
        formData.append('page', page);
        console.log(formData);
        
        // console.log(formulaire)
        // formulaire.append('imgContenu', file[0]);
        // console.log(formulaire)
  
        $.ajax({
          url: '?controller=contenu&action=createContenu', //script qui traitera l'envoi du fichier
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          success: function( result, status, xhr ) {
            if (result == 1) {
              str = '<div class="card mb-2"><div class="row g-0"><div class="col-md-8"><div class="card-body">';
              switch (type) {
                case "1":
                    str+='<img src="public/images/contenu/'+content+'" class="img-fluid rounded-start" srcset="public/images/contenu/'+content+'">'
                  break;
                case "2":
                    str += '<h5>'+content+'</h5>'
                  break;
                case "4":
                  str += '<p class="card-text"><a href="'+content+'" target="_blank" rel="noopener noreferrer">'+content+'</a></p>'
                  break;
              
                default:
                  str += '<p class="card-text">'+content+'</p>'
                  break;
              }
                          
              str += '<p class="card-text"><small class="text-muted">'+date+'</small></p></div></div></div></div>' 

              $("#contenue-new").before(str)
              $('.contenu').val("")

            }
          },
        });
      });

      /**
       * manager the create of page
       * 
       * @return message of creation || don't create || problem does by user 
       */
      $("#addPage").on("click", () => {
        let position = $('select option:selected').select().val()
        let name=$("#validationCustom03Nom").val()
        let num = $('#validationCustom03NumPage').val()
        let AsGreetPage = $('#exampleRadios1greeting').val()
        let id = $('#idUser').val(); 
        if(!AsGreetPage){
          AsGreetPage = 0
        }
        $("#addPage").removeAttr("data-bs-dismiss")
        if (!name) {
          alert('veuillez insert un nom de page'+ ': '+position)
          $("#addPage").attr("data-bs-dismiss", "modal")
        }else{
          $.ajax({
            url: '?controller=page&action=create',
            type:'post',
            data:{
               auteur: id,
               position: position,
               name: name,
               num: num,
               pageAcceuil: AsGreetPage
            },
            success: function( result, status, xhr ) {
              if (result="ok") {
                
              } else if(result="error") {
                alert('e<p class="alert alert-danger">error<p>')
              }
            }
          })
        }
      })
     
    
    // function afficherAvancement(e){
    //   if(e.lengthComputable){
    //     $('progress').attr({value:e.loaded,max:e.total})
    //   }
    // }
})
// const url = new URL('?controller=contenu&action=createContenu')
// console.log(url.hostname)

// let test = request.getRemoteHost();
// console.log("RemoteHost() : " + test);

//code image


          // console.log(file, name, date, content)
          // console.log("ok")// traitement de l'envoi d'image
    //   if ($('#imgContenu').length) {
    //     if ($('#imgContenu').select()) {
    //     $('#insert').on('click', function(){
    //       let file = $('#imgContenu').files;
    //       let date = $('#date').val();

    //       let formulaire = new FormData();
    //       // console.log(formulaire)
    //       console.log(file);
    //       console.log(file[0]);
    //       if (file.lenght  != 1) {
    //         // formulaire.append('imgContenu', file[0]);
    //         // console.log(formulaire)

    //         $.ajax({
    //           url: '?controller=contenu&action=createContenu', //script qui traitera l'envoi du fichier
    //           type: 'post',
    //           data: {
    //             formulaire: formulaire
    //           },
    //           success: function( result, status, xhr ) {
    //             // console.log(result)
    //           },
    //         });
    //       } else {
    //         $("#error").text("selectionner une image")
    //       }
    //     });
    //   }
    //   console.log("image selectionnée")
    // }
