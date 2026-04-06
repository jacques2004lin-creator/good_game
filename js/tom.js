new TomSelect("#search-input",{
    valueField: 'id',
    labelField: 'titre',
    searchField: 'titre',
    load: function(query, callback) {
        fetch('recherche.php?q=' + encodeURIComponent(query))
            .then(response => response.json())
            .then(json => {
                callback(json);
            }).catch(()=>{
                callback();
            });
    },
    onChange: function(value) {
        if(value) {
            window.location.href = 'jeux.php?id=' + value;
        }
    },
    render: {
        option: function(item, escape) {
            return `<div style="padding: 8px 12px; color: white;">
                        ${escape(item.titre)}
                    </div>`;
        },
        item: function(item, escape) {
            return `<div style="color: white;">${escape(item.titre)}</div>`;
        }
    }
});