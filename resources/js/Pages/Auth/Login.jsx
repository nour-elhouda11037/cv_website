import { useForm } from '@inertiajs/react'
import React from 'react'

export default function Login() {
    const { data, setData, post, processing, errors } = useForm({
        email: '',
        password: '',
        remember: false,
    })
    const submit = (e) => {
        e.preventDefault()
        post(route('login'))
    }
    return (
        <div>
            <h2> Welcome back! </h2>
            {Object.values(errors).map((e, i) => (
                <p key={i} style={{ color: 'red' }}>{e}</p>
            ))}
            <form onSubmit={submit}>
                <label>Email or Username
                    <input
                        name="email"
                        type="text"
                        value={data.email}
                        onChange={(e) => setData('email', e.target.value)}
                        required
                    />
                </label><br />
                <label>Password
                    <input
                        name="password"
                        type="password"
                        value={data.password}
                        onChange={(e) => setData('password', e.target.value)}
                        required
                    />
                </label><br />
                <label>
                    <input
                        type="checkbox"
                        name="remember"
                        checked={data.remember}
                        onChange={(e) => setData('remember', e.target.checked)}
                    />
                    Save password
                </label><br />
                <button type="submit" disabled={processing}> Log in</button>
                <p>No account? <a href={route('register')}>Sign up here!  </a></p>
            </form>
        </div>
    )
}