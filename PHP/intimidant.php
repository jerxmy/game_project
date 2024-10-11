<script>
    async function getFrangipute() {
        await fetch ("getFrangipute.php")
        .then((response) =>{
            if (!response.ok){
                throw new Error ("C' CAsSé");
            }
            console.log("pupute");
            let parsedResponse = response.json();
            console.log("Tartine de Raie")
            return parsedResponse;
        })
        .then((data) =>{
            console.log(data);

            return data;
        }
        ).catch((error) =>{
            console.log ("Hello there, I think theres has been a little problem, but you can play Doom Eternal, here the error:", error);
        });
    }

    async function createNewFragipute(amandes, quantity) {
        let url = "createNewFrangipute.php";
        let formData = new FormData();
        formData.append("amandes", amandes)
        formData.append("quantity", quantity)
        await fetch(url, { method: 'POST', body: formData })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("C'CaSSé");
                }

                let parsedResponse = response.text();
                return parsedResponse;
            })
            .then((data) => {
                console.log(data);

                return data;
            }
            ).catch((error) => {
                console.log('Hello there, I think theres has been a little problem, but you can play Doom Eternal, here the error:', error);
            });
    }

    let dbRequest = getFrangipute(3);
</script>