ata.forEach(function(row, index) {
                                row.no = index + 1;
                            });

                            callback({
                                draw: data.draw,
                                recordsTotal: response.data.length,
                                recordsFiltered: response.data.length,
                                data: response.data
                            });
                        });
                },
                "columns": [{
                    "data": "no"
                }, {
                    "data": "title"
                }, {
                    "data": "desc"
                }, {
                    "data": "img",
                    "render": function(data, type, row) {
                        return '<button style="max-width: 100px; max-height: 100px; onclick="deleteNews(' + row.id + ')"">Delete</button> ' +
                            '<img src="upload/' + row.img + '" alt="image" style="max-width: 100px; max-height: 100px;"> ' +
                            '<form action="edit.php" method="post">' +
                            '<input type="hidden" name="id" value="' + row.id + '">' +
                            '<button type="submit" class="btn btn-primary btn-sm">Edit</button>' +
                            '</form>';
                    }
                }]
            });
        });
    </script>
</body>

</html>