$('#dataTable').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'copy',
            text: '<i data-lucide="copy" class="w-4 h-4"></i>',
            className: 'flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-sky-500 btn bg-sky-100 hover:text-white hover:bg-sky-600 focus:text-white focus:bg-sky-600 focus:ring focus:ring-sky-100 active:text-white active:bg-sky-600 active:ring active:ring-sky-100 btn-xs'
        },
        {
            extend: 'csv',
            text: '<i data-lucide="file-text" class="w-4 h-4"></i>',
            className: 'flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-sky-500 btn bg-sky-100 hover:text-white hover:bg-sky-600 focus:text-white focus:bg-sky-600 focus:ring focus:ring-sky-100 active:text-white active:bg-sky-600 active:ring active:ring-sky-100 btn-xs'
        },
        {
            extend: 'excel',
            text: '<i data-lucide="file-spreadsheet" class="w-4 h-4"></i>',
            className: 'flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-sky-500 btn bg-sky-100 hover:text-white hover:bg-sky-600 focus:text-white focus:bg-sky-600 focus:ring focus:ring-sky-100 active:text-white active:bg-sky-600 active:ring active:ring-sky-100 btn-xs'
        },
        {
            extend: 'pdf',
            text: '<i data-lucide="file" class="w-4 h-4"></i>',
            className: 'flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-sky-500 btn bg-sky-100 hover:text-white hover:bg-sky-600 focus:text-white focus:bg-sky-600 focus:ring focus:ring-sky-100 active:text-white active:bg-sky-600 active:ring active:ring-sky-100 btn-xs'
        },
        {
            extend: 'print',
            text: '<i data-lucide="printer" class="w-4 h-4"></i>',
            className: 'flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-sky-500 btn bg-sky-100 hover:text-white hover:bg-sky-600 focus:text-white focus:bg-sky-600 focus:ring focus:ring-sky-100 active:text-white active:bg-sky-600 active:ring active:ring-sky-100 btn-xs'
        }
    ],
    language: {
        paginate: {
            previous: '<button class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-sky-500 btn bg-sky-100 hover:text-white hover:bg-sky-600 focus:text-white focus:bg-sky-600 focus:ring focus:ring-sky-100 active:text-white active:bg-sky-600 active:ring active:ring-sky-100 btn-xs"><i data-lucide="chevron-left" class="w-3 h-3"></i></button>',
            next: '<button class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-sky-500 btn bg-sky-100 hover:text-white hover:bg-sky-600 focus:text-white focus:bg-sky-600 focus:ring focus:ring-sky-100 active:text-white active:bg-sky-600 active:ring active:ring-sky-100 btn-xs"><i data-lucide="chevron-right" class="w-3 h-3"></i></button>'
        }
    },
    drawCallback: function () {
        lucide.createIcons();

        // Style bouton actif
        $('#dataTable_paginate .paginate_button.current').each(function () {
            $(this)
                .addClass('bg-sky-600 text-white btn btn-xs')
                .removeClass('current');
        });

        // Autres boutons
        $('#dataTable_paginate .paginate_button:not(.ellipsis):not(.current)').each(function () {
            $(this)
                .addClass('bg-sky-100 text-sky-500 btn btn-xs hover:bg-sky-600 hover:text-white')
                .removeClass('current');
        });
    }
});
