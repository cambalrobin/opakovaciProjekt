<?= $this->extend('layout/template') ?>
 
<?= $this->section('content') ?>
<div class="container mt-4">
 
    <h3 class="text-center mb-4">Závody kámo bráško</h3>
 
    <?php if (!empty($years)): ?>
        <?php foreach ($years as $year): ?>
            <!-- Nativní rozbalovací blok -->
            <details class="card mb-3 shadow-sm">
               
                <!-- Klikací hlavička -->
                <summary class="card-header bg-dark text-white d-flex justify-content-between align-items-center" style="cursor: pointer; list-style: none;">
                    <h5 class="mb-0">
                         <?= esc($year->real_name) ?> (<?= esc($year->year) ?>)
                    </h5>
                    <span>
                        <strong>Termín:</strong> <?= date('d.m.Y', strtotime($year->start_date)) ?> - <?= date('d.m.Y', strtotime($year->end_date)) ?>
                        | <strong>Celková dělka:</strong> <?= esc($year->total_distance ?? 0) ?> km
                    </span>
                </summary>
 
                <!-- Vnitřek s tabulkou etap -->
                <div class="card-body p-0">
                    <?php if (!empty($year->stages)): ?>
                        <table class="table table-striped table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Etapa</th>
                                    <th>Datum</th>
                                    <th>Délka</th>
                                    <th>Převýšení</th>
                                    <th>Typ etapy</th>
                                    <th>Výsledky</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($year->stages as $stage): ?>
                                    <tr>
                                        <td><?= esc($stage->number) ?>. etapa</td>
                                        <td><?= date('d.m.Y', strtotime($stage->date)) ?></td>
                                        <td><?= esc($stage->distance) ?> km</td>
                                        <td><?= esc($stage->vertical_meters) ?> m</td>
                                        <td><?= esc($stage->parcour_type) ?></td>
                                        <td>
                                            <!-- Odkazy na výsledky podle zadání (type_result 1 a 4) -->
                                            <a href="<?= base_url('results/stage/' . $stage->id . '/1') ?>" class="btn btn-sm btn-outline-primary me-1">V etapě</a>
                                            <a href="<?= base_url('results/stage/' . $stage->id . '/4') ?>" class="btn btn-sm btn-outline-secondary">Po etapě</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="p-3 text-muted text-center">Pro tento ročník nebyly nalezeny žádné etapy.</div>
                    <?php endif; ?>
                </div>
 
            </details>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center text-muted">Žádné ročníky nebyly nalezeny.</p>
    <?php endif; ?>
 
</div>
<?= $this->endSection() ?>