import React from 'react'
import "../../css/style.css";
import "../../css/app.css";
import { usePage, Link } from '@inertiajs/react'

export default function ShowCV() {
    const { resume, education, experience, skills } = usePage().props

    return (
        <div>
            <h2>{resume.title}</h2>
            <h3>Education </h3>
            <ul>
                {education.map((edu, i) => (
                    <li key={i}>
                        {edu.school_name} ({edu.degree})
                    </li>
                ))}
            </ul><h3>  Experience</h3>
            <ul>
                {experience.map((exp, i) => (
                    <li key={i}>
                        {exp.company_name} - {exp.position}
                    </li>
                ))}
            </ul><h3> Skills </h3>
            <ul>
                {skills.map((skill, i) => (
                    <li key={i}>
                        {skill.skill} ({skill.level})
                    </li>
                ))}
            </ul>
            <Link href={route('dashboard')} className="btn">
                Back
            </Link>
        </div>
    )
}