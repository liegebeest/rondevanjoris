var $table = $('#stukjes');
     $table.bootstrapTable({
	      url: 'http://rondevanjoris.com/columns.php',
	      striped: true,
	      pagination: false,
	      pageSize: 5,
	      pageList: [5, 40, 60, 100, 200],
          minimumCountColumns: 2,
          clickToSelect: true,
	      columns: [{
	          field: 'link',
	          title: 'Column',
	          align: 'left',
	          width: "150"
	      },{
	          field: 'source',
	          title: 'Bron',
	          align: 'left',
	          width: "50"
	      },{
	          field: 'date',
	          title: 'Datum',
	          align: 'left',
	          width: "100"
	      },{
	          field: 'genre',
	          title: 'Tags',
	          align: 'left',
	          width: "100"
	      }
	      ]
  	 });