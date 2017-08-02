var $table = $('#routes');
$table.bootstrapTable({
      url: 'http://rondevanjoris.com/routes.php',
      striped: true,
      pagination: true,
      pageSize: 20,
      pageList: [20, 40, 60, 100, 200],
      minimumCountColumns: 2,
      clickToSelect: true,
      columns: [{
          field: 'date',
          title: 'Datum',
          align: 'left'
      },{
          field: 'route',
          title: 'Route',
          align: 'left'
      },{
          field: 'price',
          title: 'Prijs/Persoon incl. BTW',
          align: 'left'
      },{
          field: 'places',
          title: 'Vrije plaatsen',
          align: 'left'
      }],
    });