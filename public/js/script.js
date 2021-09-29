function initSupportSocialShare() {
    //conteúdo que será compartilhado: Título da página + URL
    var url = encodeURIComponent(window.location.href); //url
    var titulo = encodeURIComponent(document.title); //título
    var conteudo = encodeURIComponent(url + titulo);
    //altera a URL do botão
    document.getElementById("fa-whatsapp-square").href = "https://api.whatsapp.com/send?text=" + conteudo;
    document.getElementById("fa-facebook-square").href = "https://www.facebook.com/sharer/sharer.php?u=" + url;
    document.getElementById("fa-twitter-square").href = "https://twitter.com/intent/tweet?url="+url+"&text="+titulo;
    //Linkedin
        var linkedinLink = "https://www.linkedin.com/shareArticle?mini=true&url="+url+"&title="+titulo;
     
        var summary = document.querySelector("meta[name='description']");
        summary = (!!summary)? summary.getAttribute("content") : null;
        
        //se a meta tag description estiver ausente...
        if(!summary){
            //...tenta obter o conteúdo da meta tag og:description
            summary = document.querySelector("meta[property='og:description']");
            summary = (!!summary)? summary.getAttribute("content") : null;
        }
        //altera o link do botão
        linkedinLink = (!!summary)? linkedinLink + "&summary=" + encodeURIComponent(summary) : linkedinLink;
        document.getElementById("fa-linkedin").href = linkedinLink;

    //Email    
        var mailToLink = "mailto:?subject="+titulo;
        //tenta obter o conteúdo da meta tag description
        var desc = document.querySelector("meta[name='description']");            
        desc = (!!desc)? desc.getAttribute("content") : null;
        
        //se a meta tag description estiver ausente...
        if(!desc){
            //...tenta obter o conteúdo da meta tag og:description
            desc = document.querySelector("meta[property='og:description']");
            desc = (!!desc)? desc.getAttribute("content") : null;
        }
        //Se houver descrição, combina a descrição com a url
        //senão o corpo da mensagem terá apenas a url
        var body = (!!desc)? desc + " " + url : url;
        //altera o link do botão
        mailToLink = mailToLink + "&body=" + encodeURIComponent(body);
        document.getElementById("fa-envelope-square").href = mailToLink;
}