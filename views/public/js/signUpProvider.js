document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  form.addEventListener("submit", async function (event) {
      event.preventDefault();

      const isProvider = window.location.pathname.includes("provider");
      const type = isProvider ? "provider" : "client"; 

      const formData = new FormData(form);
      const data = Object.fromEntries(formData.entries());

      if (data.password !== data.confirm_password) {
          alert("Les mots de passe ne correspondent pas.");
          return;
      }

      let requestBody;
      if (type === "client") {
          requestBody = {
              type: "client",
              company_name: data.company_name,
              siret_number: data.siret_number,
              legal_form: data.legal_form,
              activity_sector: data.activity_sector,
              representative_lastname: data.representative_lastname,
              representative_firstname: data.representative_firstname,
              contact_email: data.email,
              contact_phone: data.phone,
              company_website: data.website || null,
              billing_address: data.billing_address,
              postal_code: data.postal_code,
              country: data.country,
              password: data.password,
              confirm_password: data.confirm_password
          };
      } else {
          requestBody = {
              type: "provider",
              lastname: data.lastname,
              firstname: data.firstname,
              email: data.email,
              phone: data.phone,
              service_type: data.service_type,
              service_description: data.service_description,
              billing_address: data.billing_address,
              postal_code: data.postal_code,
              country: data.country,
              company_name: data.company_name || null,
              siret: data.siret || null,
              vat_number: data.vat_number || null,
              website: data.website || null,
              password: data.password,
              confirm_password: data.confirm_password
          };
      }

      console.log("Requête envoyée:", requestBody);

      try {
          const response = await fetch("/Projet-Annuel-2i1/PA2i1/api/signup.php", {
              method: "POST",
              headers: {
                  "Content-Type": "application/json"
              },
              body: JSON.stringify(requestBody)
          });

          const result = await response.json();

          console.log("Réponse de l'API:", result);

          if (result.success) {
              alert("Inscription réussie !");
              window.location.href = "/Projet-Annuel-2i1/PA2i1/views/login";
          } else {
              alert("Erreur : " + result.error);
          }
      } catch (error) {
          console.error("Erreur lors de l'inscription :", error);
          alert("Une erreur s'est produite. Veuillez réessayer.");
      }
  });
});
