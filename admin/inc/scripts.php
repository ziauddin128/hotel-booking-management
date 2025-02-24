<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script>
    function alert(type, message)
    {
        const existingAlert = document.querySelector('.custom-alert');
        if (existingAlert) {
            existingAlert.remove();
        }

        alert_type = (type == "success") ? "alert-success" : "alert-danger";
        let element = document.createElement("div");
        element.innerHTML = `<div class="alert ${alert_type} custom-alert alert-dismissible fade show" role="alert">
        <strong class="me-3">${message}</strong>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
        document.body.append(element);
    }
</script>