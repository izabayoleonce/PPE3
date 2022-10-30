$(function(){
    $('#verify').on('click',function() {
      let mail=$('#staticEmail').val()
      let regx = /(^[a-zA-Z0-9_.]+[@]{1}[a-z0-9]+[\.][a-z]+$)/mg
      let login=$('#inputLogin').val()
      let mailAcccept = regx.test(mail)
    //   console.log(mailAcccept)
      let strResult = ''
      let base = '?controller=utilisateur&action=verifyMailEndLogin'
      let xmlHttp = new XMLHttpRequest()
      xmlHttp.open( "GET", base ) // false for synchronous request
      xmlHttp.send( null )
      let http = String(xmlHttp.statusText)
      console.log(xmlHttp)
      console.log(http)
    
      if(mailAcccept === true ){
        $.ajax({
            url: http,
            method: 'post',
            data:{
                email: mail,
                login: login
            },
            success: function( result, status, xhr ) {
                // console.log(xhr)
                let strResult=''

                if ( result ) {
                    strResult=''
                }
                else{
                    strResult="Erreur"
                }
            },

        })

      }else{
        strResult += '<p class="text-danger text-center">insert un mail qui exist</p>'
        $('#message').html(strResult)
      }
    })
})
// const url = new URL('http://127.0.2.3/DM/Blog/?controller=commentaires&action=addComment')
// console.log(url.hostname)

// let test = request.getRemoteHost();
// console.log("RemoteHost() : " + test);


