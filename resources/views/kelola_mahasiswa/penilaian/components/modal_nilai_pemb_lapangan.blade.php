<div class="modal fade" id="modal-nilai-lapangan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center d-block">
                <h5 class="modal-title">Nilai Pembimbing Lapangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive border border-bottom-0 mt-4">
                    <table class="table" id="table-penilaian">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Aspek Penilaian</th>
                                <th>Deskripsi Penilaian</th>
                                <th>Nilai Max</th>
                                <th>Nilai Magang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilaiLapangan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->aspek_penilaian }}</td>
                                <td>{{ $item->deskripsi_penilaian }}</td>
                                <td>{{ $item->nilai_max }}</td>
                                <td>{{ $item->nilai ?? '-' }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <th class="text-center" colspan="4">TOTAL NILAI AKHIR MAGANG</th>
                                <th class=""><input type="text" id="nilai-akhir" class="form-control" value="{{ $nilaiAkhir }}" placeholder="-" style="max-width: 150px;" disabled /></th>
                            </tr>
                            <tr>
                                <th class="text-center" colspan="4">PREDIKAT INDEX NILAI AKHIR MAGANG</th>
                                <th class=""><input type="text" id="index-nilai" class="form-control" value="{{ $indexAkhir }}" placeholder="-" style="max-width: 150px;" disabled /></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
