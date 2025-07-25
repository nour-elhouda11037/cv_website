import React from 'react'
import { usePage, Link } from '@inertiajs/react'
import { Inertia } from '@inertiajs/inertia'

export default function Dashboard() {
    const { auth, resumes = [] } = usePage().props
    return (
        <div className="dashboard">
        <h2>Welcome back, {auth.user.username}!</h2>
            {resumes.length === 0 ? (
                <p className="no-saves">No saves yet.</p>
            ) : (
                <ul className="cv-list">

                    {resumes.map((cv) => (
                        <li key={cv.id}>
                            <strong>{cv.title}</strong><br />
                            <small>Created on {cv.created_at}</small><br />
                            <Link href={`/form/${cv.id}`}>Edit</Link>{' '}
                            <Link href={`/show/${cv.id}`}>Show</Link>{' '}
                            <Link href={`/export/${cv.id}`}>Export</Link>{' '}

                            <Link
                                href={`/delete/${cv.id}`}
                                method="delete"
                                as="button"
                                onClick={(e) => {
                                  function handleDelete(id) {
                                    if (confirm("Are you sure you want to delete this resume?")) {
                                    Inertia.delete(`/resumes/${id}`)
                                }
                                }
                                }}
                            >
                                Delete
                            </Link>
                        </li>
                    ))}
            </ul>
            )}
            <br />
            <Link href="/form" className="btn">Create a New CV</Link>
            <Link href={route('logout')} method="post" className="btn secondary" as="button">Logout</Link>
        </div>
    ) 
}
