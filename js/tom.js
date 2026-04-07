new TomSelect("#search-input", {
    create: false,
    maxOptions: 5,
    openOnFocus: false,
    sortField: {
        field: "text",
        direction: "asc"
    },
    
    onChange: function(value) {
        if(value) {
            window.location.href = 'jeux.php?id=' + value;
        }
    }
});