
const hargaDasar = {
      "Surabaya-Jakarta": 300000,
      "Surabaya-Yogyakarta": 200000,
      "Surabaya-Jember": 150000,
      "Jember-Jakarta": 250000,
      "Kalibaru-Ketapang": 8000,
      "Kalibaru-Jember": 8000
    };

    function hitungHarga() {
      let asal = document.getElementById("asal").value;
      let tujuan = document.getElementById("tujuan").value;
      let penumpang = parseInt(document.querySelector("input[name=penumpang]").value) || 1;
      let hargaField = document.getElementById("harga");

      if (asal && tujuan && asal !== tujuan) {
        let key1 = asal + "-" + tujuan;
        let key2 = tujuan + "-" + asal; 
        let dasar = hargaDasar[key1] || hargaDasar[key2] || 100000;
        let total = dasar * penumpang;

        hargaField.value = "Rp " + total.toLocaleString("id-ID");
        document.getElementById("harga_numeric").value = total;
      } else {
        hargaField.value = "";
        document.getElementById("harga_numeric").value = "";
      }
    }

    function cekForm() {
      let asal = document.getElementById("asal").value;
      let tujuan = document.getElementById("tujuan").value;
      let tanggal = document.getElementById("tanggal").value;

      if (asal === tujuan) {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Stasiun asal dan tujuan tidak boleh sama!"
        });
        return false;
      }
      if (tanggal === "") {
        Swal.fire({
          icon: "warning",
          title: "Tanggal kosong",
          text: "Tanggal berangkat harus diisi!"
        });
        return false;
      }

      Swal.fire({
        icon: "success",
        title: "Berhasil!",
        text: "Tiket berhasil dipesan."
      });
      return false; 
    }

   
    flatpickr("#tanggal", {
      dateFormat: "d-m-Y",
      minDate: "today"
    });

