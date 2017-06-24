var $table = $('#stukjes');
     $table.bootstrapTable({
	      url: 'http://rondevanjoris.be/columns.php',
	      striped: true,
	      pagination: true,
	      pageSize: 20,
	      pageList: [20, 40, 60, 100, 200],
          minimumCountColumns: 2,
          clickToSelect: true,
	      columns: [{
	          field: 'link',
	          title: 'Column',
	          align: 'left',
	          width: "500"
	      },{
	          field: 'source',
	          title: 'Bron',
	          align: 'left',
	          width: "500"
	      } ],
  	 });