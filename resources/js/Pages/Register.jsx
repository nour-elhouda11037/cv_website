import { useForm } from '@inertiajs/react'
import React from 'react'
import "../../css/style.css";
import "../../css/app.css";
export default function Register() {
    const { data, setData, post, processing, errors } = useForm({
        username: '',
        first_name: '',
        last_name: '',
        age: '',
        email: '',
        password: '',
        password_confirmation: ''
    })
    const submit = (e) => {
        e.preventDefault()
        post(route('register'))
    }
    return (
        <div>
            <h2>Create account</h2>
            {Object.values(errors).map((e, i) => (
                <p key={i} style={{ color: 'red' }}>{e}</p>
            ))}
            <form onSubmit={submit}>
                <label>Username
                    <input
                        name="username"
                        value={data.username}
                        onChange={(e) => setData('username', e.target.value)}
                        required
                    />
                </label><br />
                <label>Your First Name
                    <input
                        name="first_name"
                        value={data.first_name}
                        onChange={(e) => setData('first_name', e.target.value)}
                        required
                    />
                </label><br />
                <label>Your Last Name
                    <input
                        name="last_name"
                        value={data.last_name}
                        onChange={(e) => setData('last_name', e.target.value)}
                        required
                    />
                </label><br />
                <label>Your Age
                    <input
                        name="age"
                        type="number"
                        value={data.age}
                        onChange={(e) => setData('age', e.target.value)}
                        required
                    />
                </label><br />
                <label>Email
                    <input
                        name="email"
                        type="email"
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
                <label>Confirm the password
                    <input
                        name="password_confirmation"
                        type="password"
                        value={data.password_confirmation}
                        onChange={(e) => setData('password_confirmation', e.target.value)}
                        required
                    />
                </label><br />
                <button type="submit" disabled={processing}>Register</button>
                <p>Already registered? <a href={route('login')}>Log in from here!</a></p>
            </form>
        </div>
    )
}