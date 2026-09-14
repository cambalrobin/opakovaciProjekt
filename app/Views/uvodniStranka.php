<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container mt-4">


    <h3 class="text-center">Závody</h3>
    <?php
    $table = new \CodeIgniter\View\Table();
    
    $table->setHeading("Závod", "Rok", "Začátek", "Konec");

    foreach ($racesWithYears as $row) {
        $table->addRow($row->default_name, $row->year, $row->start_date, $row->end_date);
    }

    $template = array(
        'table_open' => '<table class="table table-bordered">',
        'thead_open' => '<thead>',
        'thead_close' => '</thead>',
        'heading_row_start' => '<tr>',
        'heading_row_end' => ' </tr>',
        'heading_cell_start' => '<th>',
        'heading_cell_end' => '</th>',
        'tbody_open' => '<tbody>',
        'tbody_close' => '</tbody>',
        'row_start' => '<tr>',
        'row_end'  => '</tr>',
        'cell_start' => '<td>',
        'cell_end' => '</td>',
        'row_alt_start' => '<tr>',
        'row_alt_end' => '</tr>',
        'cell_alt_start' => '<td>',
        'cell_alt_end' => '</td>',
        'table_close' => '</table>'
    );
    $table->setTemplate($template);

    echo $table->generate();
    ?>
</div>

<?= $this->endSection() ?>