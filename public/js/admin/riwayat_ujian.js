$("#table").DataTable({
    processing: !0,
    serverSide: !0,
    ajax: { url: URL_ADMIN + "/riwayat-ujian/datatable" },
    columns: [{ data: "index", name: "id" }, { data: "nama" }, { data: "rombel.nama" }, { data: "paket_soal.nama" }, { data: "waktu_mulai" }, { data: "opsi", name: "id" }],
});
