function AreYouSure(url) 
{
    if (confirm("Etes-vous sûr de vouloir supprimer cette donnée ?")) {
        window.location.href = url;
    }
}