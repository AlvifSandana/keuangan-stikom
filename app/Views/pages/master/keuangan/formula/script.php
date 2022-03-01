<script>
    // DataTable
    $('#tbl_master_formula').DataTable({
        'columnDefs': [{
            className: "text-center",
            "targets": [0, 1, 4, 5]
        }],
    });
    $('#tbl_master_formula_m').DataTable();

    // select2
    $('.custom-select').select2({
        width: 'resolve',
    });

    /** 
     * get item paket + formula berdasarkan id_item
     */
    function getItemPaketFormulaByIdItem(id_item) {
        $.ajax({
            url: '<?php echo base_url(); ?>/master-keuangan/formula/find/' + id_item,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {
                    showSWAL('error', data.message);
                } else {
                    // fill with data
                    $('#editf_item_kode').val(data.data[0].kode_item);
                    $('#editf_kode_formula').val(data.data[0].kode_formula);
                    $('#editf_nama_item').val(data.data[0].nama_item);
                    $('#editf_nominal_item').val(parseInt(data.data[0].nominal_item));
                    $('#editf_formula').val(data.data[0].persentase);
                    $('#add_item_kode').val(data.data[0].kode_item);
                    $('#add_kode_formula').val(data.data[0].kode_formula);
                    $('#add_nama_item').val(data.data[0].nama_item);
                    $('#add_nominal_item').val(parseInt(data.data[0].nominal_item));
                    $('#add_formula').val(data.data[0].persentase);
                }
            },
            error: function(jqXHR) {
                showSWAL('error', jqXHR);
                console.log(jqXHR);
            }
        });
    }

    function getFormulaByFilter() {
        $('#tbl_master_formula > tbody').empty();
        var filter = {
            paket_id: $('#paket_id').val() == null ? null : $('#paket_id').val(),
            semester_id: $('#semester_id').val() == null ? null : $('#semester_id').val(),
            angkatan_id: $('#angkatan_id').val() == null ? null : $('#angkatan_id').val(),
        };
        $.ajax({
            url: '<?= base_url() ?>/master-keuangan/formula/find',
            type: 'POST',
            data: filter,
            dataType: 'JSON',
            success: function(data) {
                if (data.status == 'success') {
                    var formula = data.data;
                    // create number formatter
                    var numformat = Intl.NumberFormat();
                    // table
                    var tbl = $('#tbl_master_formula').DataTable();
                    // clear table
                    tbl.clear().draw(false);
                    // re-draw table with new data
                    // iterate data
                    formula.forEach(element => {
                        tbl.row.add([element.kode_formula, element.kode_item, element.nama_item, 'Rp ' + numformat.format(element.nominal_item).toString(), element.persentase == null ? null : element.persentase.toString() + ' %', generateActionButton(element.id_item, element.id_formula, element.kode_item, element.kode_formula)]).draw(false);
                    });
                } else {
                    showSWAL('error', data.message);
                }
            },
            error: function(jqXHR) {
                showSWAL('error', jqXHR);
                console.log(jqXHR);
            }
        });
    }

    /** 
     * generate Action Button
     */
    function generateActionButton(id_item, id_formula, kode_item, kode_formula) {
        return `
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownActionMenu" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-info"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item text-${kode_formula == null ? 'success' : 'info'}" href="#" data-toggle="modal" data-target="#modal${kode_formula == null ? 'Add' : 'Edit'}Formula" onclick="getItemPaketFormulaByIdItem('${id_item}')"><i class="fas fa-fw fa-percentage"></i> ${kode_formula == null ? 'Add Formula' : 'Edit Formula'}</a>
                    <a class="dropdown-item text-danger" href="#" onclick="deleteItemFormula(${id_formula})"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                </div>
            </div>`;
    }

    function hitungNominalWithFormula(type) {
        var nominal = parseInt($('#add_nominal_item').val());
        var formula = parseFloat($('#add_formula').val());
        var nominalef = parseInt($('#editf_nominal_item').val());
        var formulaef = parseFloat($('#editf_formula').val());
        var nominal_after = 0;
        var nominal_afteref = 0;
        nominal_after = formula * nominal / 100;
        nominal_afteref = formulaef * nominalef / 100;
        $('#add_nominal_after').val(nominal_after);
        $('#editf_nominal_after').val(nominal_afteref);
    }

    /** 
     * tambah formula
     */
    function addFormula() {
        var data_formula = {
            item_kode: $('#add_item_kode').val(),
            persentase: $('#add_formula').val(),
        };
        $.ajax({
            url: '<?php echo base_url(); ?>/master-keuangan/formula/create',
            type: 'POST',
            data: data_formula,
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {
                    showSWAL('error', data.message);
                    console.log(data.data);
                } else {
                    showSWAL('success', data.message);
                    window.location.reload();
                }
            },
            error: function(jqXHR) {
                showSWAL('error', jqXHR);
                console.log(jqXHR)
            }
        });
    }

    /** 
     * update formula
     */
    function updateFormula() {
        var data_formula = {
            kode_formula: $('#editf_kode_formula').val(),
            item_kode: $('#editf_item_kode').val(),
            persentase: $('#editf_formula').val(),
        };
        $.ajax({
            url: '<?php echo base_url(); ?>/master-keuangan/formula/update',
            type: 'POST',
            data: data_formula,
            dataType: 'JSON',
            success: function(data) {
                if (data.status != 'success') {
                    showSWAL('error', data.message);
                    console.log(data.data);
                } else {
                    showSWAL('success', data.message);
                    window.location.reload();
                }
            },
            error: function(jqXHR) {
                showSWAL('error', jqXHR);
                console.log(jqXHR)
            }
        });
    }

    /** 
     * hapus formula
     */
    function deleteFormula(id_formula) {
        Swal.fire({
            title: 'Apakah Anda yakin ingin menghapus formula item ini?',
            text: "Tindakan ini tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url(); ?>/master-keuangan/formula/delete/' + id_formula,
                    type: 'DELETE',
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status != 'success') {
                            showSWAL('error', data.message);
                        } else {
                            showSWAL('success', data.message);
                        }
                    },
                    error: function(jqXHR) {
                        showSWAL('error', jqXHR);
                    }
                });
            }
        });
    }
</script>