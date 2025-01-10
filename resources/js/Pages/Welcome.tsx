import ApplicationLogo from '@/Components/ApplicationLogo';
import PrimaryButton from '@/Components/PrimaryButton';
import { PageProps, User } from '@/types';
import { Head, router } from '@inertiajs/react';

export default function Welcome({
    auth,
    appTitle,
}: PageProps<{
    auth: { user: User };
    appTitle: string;
}>) {
    return (
        <>
            <Head title="Bienvenido" />
            <div className="min-h-screen bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
                <main className="flex min-h-screen flex-col items-center justify-center gap-y-10">
                    <ApplicationLogo height="300vw" width="300vw" />
                    <div className="text-xl">{appTitle}</div>
                    {auth.user ? (
                        <PrimaryButton
                            onClick={() => {
                                router.get(route('dashboard'));
                            }}
                        >
                            Ir al dashboard
                        </PrimaryButton>
                    ) : (
                        <PrimaryButton
                            onClick={() => {
                                router.get(route('login'));
                            }}
                        >
                            Inicia sesión
                        </PrimaryButton>
                    )}
                </main>
            </div>
        </>
    );
}
