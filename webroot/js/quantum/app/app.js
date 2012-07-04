

Quantum.provide('App', {
 
 
 
    boot: function() {
        
       
        //alert('holaaaaa');
      
        
        
        
    },
    
    Pages: {
        
        Welcome: {
            
            boot: function() {
                
                
               Quantum.App.Facebook.init();
                
		 $('#login-button').click(function(){
                    
		    FB.login(function(response) {
			if (response.authResponse) {
			  var access_token =   response.authResponse.accessToken;
			  //alert(App.Config.url+'/app/addphone?access_token='+access_token+'&authorized=1');
			  window.location = App.Config.url+'/app/addphone?access_token='+access_token+'&authorized=1';
			  
			} else {
			  
			}
		    }, {scope: 'email'});
		    
                });

		    FB.Event.subscribe('auth.login', function(response) {
				  if (response.authResponse) {
				      var access_token =   FB.getAuthResponse()['accessToken'];
				      FB.api('/me', function(response) {
					  //window.location = App.Config.url+'/app/addphone';
					  window.location = App.Config.url+'/app/addphone?access_token='+access_token+'&authorized=1';
				      });
					//alert(App.Config.url+'/app/addphone?access_token='+access_token+'&authorized=1');
					//window.location = App.Config.url+'/app/addphone?access_token='+access_token+'&authorized=1';
				  }
			      });
			       
			      
			    
			      
	    }   
            
            
        },
        
        
        AddPhone: {
            
            
            boot: function() {
                
                Quantum.App.Facebook.init();
                
                $('.phon').each(function() {
                    var default_value = this.value;
                    $(this).focus(function() {
                        if(this.value == default_value) {
                            this.value = '';
                        }
                    });
                    $(this).blur(function() {
                        if(this.value === '') {
                            this.value = default_value;
                        }
                    });
                });
                
                $('#shout-button').click(function()  {
                    
                  Quantum.App.UI.shootOut();
                    
                });
                
               //$.facebook('scrollTop', 320);
	       
	       $('.phon').keypress(App.Validator.validateNumber);
	       
	       $('input.autotab').autotab();
            }
        },
        
        UnknownNumber: {
            
            
            boot: function() {
                
                Quantum.App.Facebook.init();
                
                $('#shout-button').click(function()  {
                    
                  Quantum.App.UI.shootOut();
                    
                });
                
               //$.facebook('scrollTop', 320);
            }
        },
        
        Share: {
            
            
            boot: function() {
                
                Quantum.App.Facebook.init();
                
                $('#share-promocode-button-with-friends').click(function()  {
                    
                  Quantum.App.UI.sharePromoCodeWithFriends();
                    
                });
                
                $('#share-promocode-button').click(function()  {
                    
                  Quantum.App.UI.shareOnOwnWall();
                    
                });
		
		
		
                
            }
        },
        
        
        StoreIndex: {
            
            boot: function() {
                
                    window.Store = App.Pages.StoreIndex;
                
                    $("select").uniform();
                    
                    $('.promocode').each(function() {
                        var default_value = this.value;
                        $(this).focus(function() {
                                if(this.value == default_value) {
                                        this.value = '';
                                        $(this).css('color', '#cc0000');
                                        $(this).css('text-transform', 'uppercase');
                                }
                        });
                        $(this).blur(function() {
                                if(this.value == '') {
                                        $(this).css('color', '#fff');
                                        $(this).css('text-transform', 'none');
                                        this.value = default_value;
                                }
                        });
		    });
                    
                    $('#check-code-button').click(function()  {
                    
                            Store.codeToCheck = $('#promo_code_field').val();
                            
			    data = Quantum.App.Datalink.checkPromoCode(Store.codeToCheck, Store.showOkMessage, Store.showErrorMessage);
			    
			    
                    
                    });
                    
                    $('#submit-form-button').click(function()  {
                    
                            Quantum.App.Datalink.submitStoreForm();
                    
                    });
                    
                    $('#download-pdf-button').click(function()  {
                    
                            var url = Store.promoCodePdfUrl;
                        
                            window.open(url);
                    
                    });
		    
		    $('input.autotab').autotab();
		    
		    $('#phone1').keypress(App.Validator.validateNumber);
		    $('#phone2').keypress(App.Validator.validateNumber);
		    $('#phone3').keypress(App.Validator.validateNumber);
                    
                    
                    
                    
                
                
            },
            
            
            showErrorMessage: function(){
				
                $('.advertino').animate({ "height" : "44px"},300);
                setTimeout("App.Pages.StoreIndex.hideErrorMessage()",4000);
                  
	    },
			
            hideErrorMessage: function(){
				
		$('.advertino').animate({ "height" : "0px"},300);
				
	    },
			
            showOkMessage: function() {
			  
                $('.advertiok').animate({ "height" : "44px"},300);
                setTimeout("App.Pages.StoreIndex.hideOkMessage()",4000);
			  
	    },
			
	    hideOkMessage: function(){
				
		$('.advertiok').animate({ "height" : "0px"},300);
				
	    },
			
            goPageTwo: function(){
				
                $('.microb').css({ "display" : "block"});			
                $('.bodymicroone').animate({ "margin-top" : "-1022px"},400);
				
	    },
			 
	    goPageOne: function(){
                
            $('#promo_code_field').val('');
              
            $('#phone1').val('');
            $('#phone2').val('');
            $('#phone3').val('');
              
            $('.bodymicroone').animate({ "margin-top" : "0px"},400, function() {
              $('.microb').css({ "display" : "none"});	
              });
            
                
				//
	    }
            
        }
        
        
        
        
    },
    
    Config: {
        
        
        setLanguage: function(language) {
            App.Config.language = language;
        },
        
        
        setAppId: function(id) {
            App.Config.appId = id;
        },
        
        setAppUrl: function(url) {
            App.Config.url = url;
        },
        
        setAppPageUrl: function(url) {
            App.Config.pageUrl = url;
        },
        
        setPromoCode: function(code) {
            App.Config.promoCode = code;
        },
	
	setPromoCodeHash: function(hash) {
            App.Config.promoCodeHash = hash;
        },
        
        setFacebookUserId: function(id) {
            App.Config.fbuid = id;
        }
        
        
        
    },
    
    
    
    /**
     * This block encapsulates all methods for UI Validation.
    */
    Validator: {
	
	
	
	/**
	 * This function should only allow numbers to be input into a field                                                                                    
	*/
	validateNumber: function(event) {
	    
	     var key = window.event ? event.keyCode : event.which;

	    if (event.keyCode == 8 || event.keyCode == 46
	     || event.keyCode == 37 || event.keyCode == 39) {
		return true;
	    }
	    else if ( key < 48 || key > 57 ) {
		return false;
	    }
	    else return true;
	}
	
    },
    
    
    
    
    
    /**
     * This block encloses all the facebook methods,
     * including the dialogs stuff
    */
    Facebook: {
        
        
        init: function() {
           
            //alert(App.Config.url+'/app/channel');
            FB.init({
                appId      : App.Config.appId,
                channelUrl : App.Config.url+'/app/channel', // Channel File
                locale: App.Config.language == 'fr' ? 'fr_CA' : 'en_US',
                status     : true, // check login status
                cookie     : true, // enable cookies to allow the server to access the session
                xfbml      : true,  // parse XFBML
                frictionlessRequests : true
            });
            //FB.Canvas.setAutoGrow();
            //FB.Canvas.setSize({ height: 1200, width: 840 });
	    FB.Canvas.setAutoGrow();
	    //FB.Canvas.setSize();
	     
	   
            
        }
    },
    
    
    UI: {
        
        shootOut: function() {
            
            FB.ui({
                method: 'feed',
                link: App.Config.url+'/app/fanpage/ref-shootout',
                name: App.Config.language == 'fr' ? 'Aide-moi à t’aider!' : 'Help me help you!',
                caption: App.Config.language == 'fr' ? 'Recommandez un ami à Virgin Mobile' : 'Refer a Friend to Virgin Mobile',
                picture: App.Config.url+'/img/75x75.jpg',
                description: App.Config.language == 'fr' ? 'Hé! Es-tu un Membre Virgin Mobile? Recommande-moi pour que je me joigne à Virgin Mobile et on profitera tous les deux d’une carte-cadeau de 50 $! Génial!' : 'Hey, are you a Virgin Mobile Member?  Refer me to join Virgin Mobile and we both score a $50 gift card! Sweet.'
            });
            
        },
        
        shareWithSelectedFriends: function(r) {
           
           
           
            
            FB.ui({
                method: 'apprequests',
                link: App.Config.url+'/app/fanpage/website-virgin-'+App.Config.language,
                to: r.to,
                display: 'page',
                name: App.Config.language == 'fr' ? 'Wow! Une offre d’enfer de Virgin Mobile!' : 'OMG!  Awesome offer from Virgin Mobile!',
                caption: App.Config.language == 'fr' ? 'Recommandez un ami à Virgin Mobile' : 'Refer a Friend to Virgin Mobile',
                picture: App.Config.url+'/img/75x75.jpg',
                message: App.Config.language == 'fr' ? 'Hé! J’adore les avantages de Membre auxquels j’ai droit chez Virgin Mobile. En te branchant en ligne avec ce code promo : '+App.Config.promoCode+', on profitera tous les deux d’une carte-cadeau de 50 $ de la part de marques extraordinaires. Ainsi, tout le monde est génial! Jettes-y un œil!' : 'Hey!  I love the Member benefits I get from Virgin Mobile. If you hook up online using this promo code: '+App.Config.promoCode+' we’ll both get  to choose a $50 gift card from some awesome brands.  Then we can all be awesome together.  Check it out!'
            });
                
        },
        
        
        sharePromoCodeWithFriends: function() {
            FB.ui({
                caption: App.Config.language == 'fr' ? 'Recommandez un ami à Virgin Mobile' : 'Refer a Friend to Virgin Mobile',
                picture: App.Config.url+'/img/75x75.jpg',
                method: 'apprequests',
                message: App.Config.language == 'fr' ? 'Hé! J’adore les avantages de Membre auxquels j’ai droit chez Virgin Mobile. En te branchant en ligne avec ce code promo : '+App.Config.promoCode+', on profitera tous les deux d’une carte-cadeau de 50 $ de la part de marques extraordinaires.' : 'Hey!  I love the Member benefits I get from Virgin Mobile. If you hook up online using this promo code: '+App.Config.promoCode+' we’ll both get  to choose a $50 gift card from some awesome brands.  Then we can all be awesome together.  Check it out!'
            },function(response) {
                if (response.to != undefined) {
                   
                    App.UI.sendRequestToManyRecipients(response.to);
                }
                
                });
            
            
        
        },
        
        sendRequestToManyRecipients: function(user_ids) {
           
            FB.ui({
              method: 'apprequests',
              link: App.Config.url+'/app/fanpage/website-virgin-'+App.Config.language,
              message: App.Config.language == 'fr' ? 'Hé! J’adore les avantages de Membre auxquels j’ai droit chez Virgin Mobile. En te branchant en ligne avec ce code promo : '+App.Config.promoCode+', on profitera tous les deux d’une carte-cadeau de 50 $ de la part de marques extraordinaires.' : 'Hey!  I love the Member benefits I get from Virgin Mobile. If you hook up online using this promo code: '+App.Config.promoCode+' we’ll both get  to choose a $50 gift card from some awesome brands.  Then we can all be awesome together.  Check it out!',
              to: user_ids
            }, Quantum.App.UI.requestCallback);
        
        },

        
        requestCallback: function(response) {
         
        },
        
        shareOnOwnWall: function() {
	    
	    var pdfUrl = App.Config.url+'/app/pdf?c='+App.Config.promoCode+'&h='+App.Config.promoCodeHash+'&view=fb';
            FB.ui(
		{
                method: 'feed',
		display: 'popup',
                link: App.Config.language == 'fr' ? 'http://www.virginmobile.ca/fr/members-lounge/refer-a-friend.html' : 'http://www.virginmobile.ca/en/members-lounge/refer-a-friend.html',
                name: App.Config.language == 'fr' ? 'Branchez-vous à Virgin Mobile et obtenez une carte-cadeau de 50 $ des marques les plus populaires!' : 'Hook up with Virgin Mobile and get a $50 gift card from the hottest brands!',
                caption: App.Config.language == 'fr' ? 'Recommandez un ami à Virgin Mobile' : 'Refer a Friend to Virgin Mobile',
                picture: App.Config.url+'/img/75x75.jpg',
		actions: { name: App.Config.language == 'fr' ? 'Télécharger coupon' : 'Download coupon', link: ''+pdfUrl+'' },
                description: App.Config.language == 'fr' ? 'Hé! Les Membres ont droit à des offres et accès exclusifs, juste parce qu’ils font partie de la famille Virgin Mobile. Si vous vous branchez avec le code promotionnel '+App.Config.promoCode+', on aura tous les deux droit à une carte-cadeau de 50 $ chez H&M, Cinéplex ou Body Shop. Manquez-vous quelque chose?' : 'Hey! Members get exclusive access and deals just for being with Virgin Mobile. If you hook up with promo code '+App.Config.promoCode+' we’ll both get to choose a $50 gift card from H&M, Cineplex or Body Shop. Are you missing out?'   
		}, function(response) {
		    if (response && response.post_id) {
		    
		    //alert('Post was published.');
		    window.postalert();

		  } else {
		    //alert('Post was not published.');
		  }
		}
	    );
    
        }
   
    },
    
    /**
     * Datalink: checks for promocode through the member api
     * The member api needs a code parameter
     * It fires a onSuccessCallback, and an OnErrorCallback
     * The callback will be called with the error, or with the member data
     */
    Datalink: {
            
            
            checkPromoCode: function(code, onSuccessCallback, onErrorCallback) {
                
                params = {code: code.toUpperCase()};
                
                Quantum.App.Datalink.XDGET('/api/member', params, function(data) {
                    
		    if (data.error) {
			onErrorCallback.call(data.error);
                    } else if (data.first_name){
                        onSuccessCallback.call(data)
                    }
                    
                });
                
            },
            
            checkPhoneNumber: function() {
                
                
            },
            
            
            submitStoreForm: function() {
                
              
            Store.codeToCheck = $('#promo_code_field').val();
              
              var phone1 = $('#phone1').val();
              var phone2 = $('#phone2').val();
              var phone3 = $('#phone3').val();
              
              var phone = phone1+phone2+phone3;
              
              Store.phoneToCheck = phone;
              
              params = {code:Store.codeToCheck.toUpperCase(), phone: Store.phoneToCheck, activation:'in_store'};
              
               Quantum.App.Datalink.POST('/store/', params, function(data) {
                    
                    if (data.error) {
                       
                        e = $.parseJSON(data.responseText)
                        
                        
                        
                        if (e.error == 'invalid_phone') {
                            alert('Invalid Phone Number');
                        }
                        
                         if (e.error == 'invalid_promo_code') {
                            Store.showErrorMessage();
                        }
                       
                        
                    } else if (data.first_name){
                        
                        Store.promoCodePdfUrl = data.pdf_url;
                        Store.validPromoCode = data.promo_code;
                        
                        
                        Store.goPageTwo();
                    }
                    
              });
                
            },
            
            XDGET: function(url, data, callback) {
                
                $.ajax({
                    url: url,
                    dataType: 'json',
                    data: data,
                    success: callback,
                    
                    error:function (error){
                        callback(error);
                    }
                });
            },
            
            POST: function(url, data, callback) {
                
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    data: data,
                    success: callback,
                    
                    error:function (error){
                        
                        callback(error);
                    }
                });
            }
            
            
    }
        
        
   
    
    
            
            

            
            
});

window.App = Quantum.App;