@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- Modal content -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Multistep Modal
                        </h3>
                        <div class="mt-2">
                            <!-- Steps content -->
                            <div id="step1" class="step">
                                <p class="text-sm text-gray-500">Step 1: Enter your name</p>
                                <input type="text" id="name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                            <div id="step2" class="step hidden">
                                <p class="text-sm text-gray-500">Step 2: Enter your email</p>
                                <input type="email" id="email"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                            <div id="step3" class="step hidden">
                                <p class="text-sm text-gray-500">Step 3: Review your information</p>
                                <p id="reviewName" class="mt-2"></p>
                                <p id="reviewEmail" class="mt-2"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button id="nextButton"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Next
                </button>
                <button id="backButton"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm hidden">
                    Back
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentStep = 1;

    const steps = document.querySelectorAll('.step');
    const nextButton = document.getElementById('nextButton');
    const backButton = document.getElementById('backButton');

    function showStep(step) {
        steps.forEach((stepEl, index) => {
            stepEl.classList.toggle('hidden', index + 1 !== step);
        });

        backButton.classList.toggle('hidden', step === 1);
        nextButton.textContent = step === steps.length ? 'Finish' : 'Next';
    }

    nextButton.addEventListener('click', () => {
        if (currentStep === 2) {
            document.getElementById('reviewName').textContent =
            `Name: ${document.getElementById('name').value}`;
            document.getElementById('reviewEmail').textContent =
                `Email: ${document.getElementById('email').value}`;
        }

        if (currentStep < steps.length) {
            currentStep++;
            showStep(currentStep);
        } else {
            // Handle form submission or finish action
            alert('Form submitted');
        }
    });

    backButton.addEventListener('click', () => {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });

    showStep(currentStep);
</script>
