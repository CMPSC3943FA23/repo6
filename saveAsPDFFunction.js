document.querySelector("#savePDF").addEventListener("click", function() {
            let contentToSave = document.querySelector('.container.mt-5');
    
            let opt = {
                margin:       10,
                filename:     'HobbyHarmony.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };
        
            html2pdf().from(contentToSave).set(opt).save();
        });
