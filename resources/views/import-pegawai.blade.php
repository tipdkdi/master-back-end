<html>

<head>
    <style>
        table,
        td,
        th {
            border: 1px solid;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>
</head>

<body id="body">

    <h1>Import Pegawai dari Simpeg ke Data Master</h1>
    <table>
        <thead>
            <th>No.</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Email</th>
        </thead>
        <tbody class="tbody">

        </tbody>
    </table>
</body>
<script>
    init()
    async function init() {
        let url = "https://simpeg.iainkendari.ac.id/ApiUntukMaster/data_pegawai"
        let dataSend = new FormData()
        let send = await fetch(url);

        let response = await send.json();
        console.log(response)
        let contents = ""
        response.map(async (data, index) => {
            // if (index < 10) {
            contents += `<tr>
                                    <td>${index+1}</td>
                                    <td>${data.nip}</td>
                                    <td>${data.nama}</td>
                                    <td>${data.email}</td>
                                </tr>`
            // if (index == 0) {
            // console.log(item);
            // return console.log('ggwp');
            let url = "{{route('import.pegawai')}}";
            let dataSend = new FormData()
            // let token = "token"
            dataSend.append('data', JSON.stringify(data))
            let sendRequest = await fetch(url, {
                method: "POST",
                // headers: {
                //     "Authorization": `Bearer ${token}`, // Menambahkan Bearer Token
                //     "Content-Type": "application/json" // Header lain jika diperlukan
                // },
                body: dataSend
            })
            let response = await sendRequest.json()
            console.log(response);
            // if (response.status)

            // }
            // console.log(item.nama);

            // }
        })
        document.querySelector('.tbody').innerHTML = contents
    }
</script>

</html>