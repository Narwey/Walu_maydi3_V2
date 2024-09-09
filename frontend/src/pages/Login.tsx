'use client'

import { useState } from 'react'

export default function LoginForm() {
 
  const [loginData, setLoginData] = useState({
    email: '' ,
    password: ''
  });

  const handleLoginChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setLoginData({ ...loginData, [e.target.name]: e.target.value });
  };

  const handleLoginSubmit = async (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    
    try {
        const response = await fetch('http://localhost:8000/api/login', {
          method: "POST",
          headers : { "Content-Type": "application/json" },
          body: JSON.stringify(loginData)
    });
      const data = await response.json();
      localStorage.setItem("data", JSON.stringify(data));
      alert("LOGGED IN SUCCESSFULLY");
    }
    catch (error) {
      console.error("Error during login:", error);
      alert("ERROR");
    }
  };

  return (
    <div className="flex items-center justify-center h-full">
      <div className="w-full max-w-md bg-white rounded-lg shadow-md p-8">
        <h2 className="text-2xl font-bold mb-6 text-center">
          Login
        </h2>
        <form onSubmit={handleLoginSubmit} className="space-y-4">
          <div>
            <label htmlFor="email" className="block text-sm font-medium text-gray-700">
              Email
            </label>
            <input
              id="email"
              type="email"
              name='email'
              placeholder="m@example.com"
              value={loginData.email}
              onChange={handleLoginChange}
              required
              className="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md text-sm shadow-sm placeholder-gray-400
                        focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
            />
          </div>
          <div>
            <label htmlFor="password" className="block text-sm font-medium text-gray-700">
              Password
            </label>
            <input
              id="password"
              type="password"
              name='password'
              value={loginData.password}
              onChange={handleLoginChange}
              required
              className="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md text-sm shadow-sm placeholder-gray-400
                        focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
            />
          </div>
          <button
            type="submit"
            className="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
          >
            Login
          </button>
        </form>
        <div className="mt-4 text-center">
          <p className="text-sm text-gray-600">
            Don't have an account? 
            <a href="/register" className="text-blue-600 hover:text-blue-500 font-medium"> Register here</a>
          </p>
        </div>
      </div>
    </div>
  )
}