function AreYouSure(action, url) 
{
    if (action === 'report') {
        if (confirm("Etes-vous sûr de vouloir signaler ce commentaire ?")) {
            window.location.href = url;
        }
    } else if (action === 'delete') {
        if (confirm("Etes-vous sûr de vouloir supprimer cet article ?")) {
            window.location.href = url;
        }
    }
}