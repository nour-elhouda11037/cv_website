import React from 'react'

import { Link } from '@inertiajs/react'
import AppLayout from '@/Layouts/AppLayout'

export default function Home() {

    return (

        <AppLayout>
            <header className="hero">
                <div className="hero-content">
                    <h1>Create Your CV Easily!</h1>
                    <p>Build, export and manage your CV in just a few clicks</p>
                    <div className="buttons">
                        <Link href="/register" className="btn">Get Started</Link>
                        <Link href="/login" className="btn secondary">Login</Link>
                    </div>
                </div>
            </header>
        </AppLayout>

    )

}