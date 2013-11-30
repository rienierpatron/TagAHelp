TAGCASH = {};
TAGCASH.profile = {
    deleteWallet: function(){
        $('.btnDelete').on('click',function(){
            var confirmation=confirm("Would you like to delete this wallet?");
            if(confirmation == true){
                return true;
            }else{
                return false;
            }
        });
    },
    hideFlash: function(){
        setTimeout( "jQuery('#flash').slideUp();",3000 );
    },

};