pages = pages || {};
pages.registration = `
  <div class="flex flex-col items-center justify-center min-h-[500px] py-10">
    <div class="text-3xl font-bold text-gray-800 mb-2">ExportLink</div>
    <div class="text-lg text-gray-600 mb-8">Create Your Account</div>
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
      <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">User Registration</h2>
      <div class="space-y-4">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name:</label>
          <input type="text" id="name" placeholder="John Doe" class="w-full">
        </div>
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address:</label>
          <input type="email" id="email" placeholder="john.doe@example.com" class="w-full">
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password:</label>
          <input type="password" id="password" placeholder="••••••••" class="w-full">
        </div>
        <button class="btn-primary w-full mt-4" onclick="loadPage('login')">REGISTER</button>
      </div>
      <p class="text-center text-sm text-gray-600 mt-6">
        Already have an account? <a href="#" class="link-text" onclick="loadPage('login')">Login</a>
      </p>
    </div>
  </div>
`;
// This page will allow users to register by providing their name, email, and password.