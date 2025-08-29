import React from 'react'
import "../../css/style.css";
import "../../css/app.css";
import { Link, usePage } from '@inertiajs/react'

export default function AppLayout({ children }) {
    const { auth } = usePage().props

    return (
      <div className="app">
        <nav className="nav">
          <Link href="/">Home</Link>

          {auth?.user ? (
           <>
             <Link href="/dashboard">Dashboard</Link>
             <Link href={route('logout')} method="post" as="button">
               Logout
             </Link>
           </>
          ) : (
           <>
             <Link href="/login">Login</Link>
             <Link href="/register">Sign up</Link>
           </>
          )}
        </nav>

        <main>{children}</main>

        <footer className="footer">© 2025 CV Builder</footer>
      </div>
    )
  }
